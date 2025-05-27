<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use App\Models\Hangout;
use App\Models\Location;
use App\Models\VisitorInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $newPlace = Hangout::latest()->take(4)->get();
        $excludedIds = $newPlace->pluck('id');

        $otherPlaces = Hangout::whereNotIn('id', $excludedIds)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $locations = Location::withCount('hangouts')
            ->take(5)
            ->get();


        return view('home.index', compact('newPlace', 'otherPlaces', 'locations'));
    }

    public function directories(Request $request)
    {
        $query = Hangout::with('location')->where('status', 1);

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        $hangouts = $query->paginate(6)->withQueryString();
        $locations = Location::all();

        return view('home.directories', compact('hangouts', 'locations'));
    }


    public function show($slug, Request $request)
    {
        $hangout = Hangout::where('slug', $slug)->firstOrFail();
        $visitorId = $request->cookie('visitor_id');

        $alreadyViewed = VisitorInteraction::where('visitor_id', $visitorId)
            ->where('hangout_id', $hangout->id)
            ->where('interaction_type', 'view')
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$alreadyViewed && $visitorId) {
            VisitorInteraction::create([
                'visitor_id' => $visitorId,
                'hangout_id' => $hangout->id,
                'interaction_type' => 'view',
            ]);
        }

        $lastLike = null;
        $lastRating = null;

        if ($visitorId) {
            $lastLike = VisitorInteraction::where('visitor_id', $visitorId)
                ->where('hangout_id', $hangout->id)
                ->where('interaction_type', 'like')
                ->latest()
                ->first();

            $lastRating = VisitorInteraction::where('visitor_id', $visitorId)
                ->where('hangout_id', $hangout->id)
                ->where('interaction_type', 'rating')
                ->latest()
                ->first();
        }

        $lastLike = VisitorInteraction::where('visitor_id', $visitorId)
            ->where('hangout_id', $hangout->id)
            ->where('interaction_type', 'like')
            ->latest()->first();

        $lastRating = VisitorInteraction::where('visitor_id', $visitorId)
            ->where('hangout_id', $hangout->id)
            ->where('interaction_type', 'rating')
            ->latest()->first();

        $mostLiked = Hangout::selectRaw('hangouts.id, hangouts.name, hangouts.thumbnail, hangouts.slug, COUNT(visitor_interactions.id) as like_count')
            ->where('hangouts.slug', '!=', $slug)
            ->join('visitor_interactions', 'hangouts.id', '=', 'visitor_interactions.hangout_id')
            ->where('interaction_type', 'like')
            ->groupBy('hangouts.id', 'hangouts.name', 'hangouts.slug', 'hangouts.thumbnail')
            ->orderByDesc('like_count')
            ->take(5)
            ->get();


        return view('home.read', compact('hangout', 'lastLike', 'lastRating', 'mostLiked'));
    }


    public function interact(Request $request, $slug)
    {
        $request->validate([
            'interaction_type' => 'required|in:view,like,bookmark,share,rating',
            'rating_value' => 'nullable|integer|min:1|max:5',
        ]);

        $hangout = Hangout::where('slug', $slug)->firstOrFail();
        $visitorId = $request->cookie('visitor_id');

        $data = [
            'visitor_id' => $visitorId,
            'hangout_id' => $hangout->id,
            'interaction_type' => $request->interaction_type,
        ];

        if ($request->interaction_type === 'rating') {
            $data['rating_value'] = $request->rating_value;
        }

        VisitorInteraction::updateOrCreate(
            [
                'visitor_id' => $visitorId,
                'hangout_id' => $hangout->id,
                'interaction_type' => $request->interaction_type,
            ],
            $data
        );

        return response()->json(['message' => 'Interaction recorded']);
    }


}
