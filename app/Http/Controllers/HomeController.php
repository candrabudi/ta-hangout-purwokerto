<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use App\Models\Hangout;
use App\Models\Location;
use App\Models\Visitor;
use App\Models\VisitorInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $visitorId = $request->cookie('visitor_id');
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

        $checkVisitor = Visitor::where('id', $visitorId)
            ->where('device_info', $request->userAgent())
            ->exists();

        if (!$checkVisitor) {
            $visitor = Visitor::create([
                'id' => (string) Str::uuid(),
                'device_info' => $request->userAgent(),
            ]);

            $visitorId = $visitor->id;
            Cookie::queue('visitor_id', $visitorId, 60 * 24 * 30);
        }

        $alreadyViewed = VisitorInteraction::where('visitor_id', $visitorId)
            ->where('hangout_id', $hangout->id)
            ->where('interaction_type', 'view')
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$alreadyViewed) {
            VisitorInteraction::create([
                'visitor_id' => $visitorId,
                'hangout_id' => $hangout->id,
                'interaction_type' => 'view',
            ]);
        }

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

        $recommendedBasedOnRating = Hangout::selectRaw('hangouts.*, AVG(visitor_interactions.rating_value) as avg_rating')
            ->join('visitor_interactions', 'hangouts.id', '=', 'visitor_interactions.hangout_id')
            ->where('interaction_type', 'rating')
            ->groupBy('hangouts.id', 'location_id', 'hangouts.name', 'hangouts.slug')
            ->having('avg_rating', '>=', 3)
            ->inRandomOrder()
            ->take(5)
            ->get();


        $nearestHangouts = collect();
        $visitorLat = session('visitor_latitude');
        $visitorLng = session('visitor_longitude');

        if ($visitorLat && $visitorLng) {
            $nearestHangouts = Hangout::with('location')
                ->whereHas('location', function ($q) {
                    $q->whereNotNull('latitude')->whereNotNull('longitude');
                })
                ->get()
                ->map(function ($item) use ($visitorLat, $visitorLng) {
                    $lat = $item->location->latitude;
                    $lng = $item->location->longitude;

                    $theta = $visitorLng - $lng;
                    $dist = sin(deg2rad($visitorLat)) * sin(deg2rad($lat)) +
                        cos(deg2rad($visitorLat)) * cos(deg2rad($lat)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles = $dist * 60 * 1.1515;
                    $item->distance_km = round($miles * 1.609344, 2);
                    return $item;
                })
                ->sortBy('distance_km')
                ->take(5);
        }


        return view('home.read', compact('hangout', 'lastLike', 'lastRating', 'recommendedBasedOnRating', 'nearestHangouts'));
    }



    public function storeLocation(Request $request)
    {
        session([
            'visitor_latitude' => $request->latitude,
            'visitor_longitude' => $request->longitude,
        ]);

        return response()->json(['status' => 'ok']);
    }



    public function interact(Request $request, $slug)
    {
        $request->validate([
            'interaction_type' => 'required|in:view,like,bookmark,share,rating',
            'rating_value' => 'nullable|integer|min:1|max:5',
        ]);

        $hangout = Hangout::where('slug', $slug)->firstOrFail();
        $visitorId = $request->cookie('visitor_id');

        $existingInteraction = VisitorInteraction::where([
            'visitor_id' => $visitorId,
            'hangout_id' => $hangout->id,
            'interaction_type' => $request->interaction_type,
        ])->first();


        if ($existingInteraction) {
            if ($request->interaction_type === 'rating') {
                $existingInteraction->rating_value = $request->rating_value;
                $existingInteraction->save();
                $message = 'Rating Anda berhasil diperbarui.';
            } else {
                $message = 'Interaksi Anda sudah tercatat sebelumnya.';
            }
        } else {
            $interaction = new VisitorInteraction();
            $interaction->visitor_id = $visitorId;
            $interaction->hangout_id = $hangout->id;
            $interaction->interaction_type = $request->interaction_type;

            if ($request->interaction_type === 'rating') {
                $interaction->rating_value = $request->rating_value;
                $message = 'Terima kasih, rating Anda telah dikirim.';
            } else {
                $message = match ($request->interaction_type) {
                    'like' => 'Anda menyukai tempat ini.',
                    'bookmark' => 'Tempat ini telah disimpan.',
                    'share' => 'Terima kasih telah membagikan tempat ini.',
                    'view' => 'Kunjungan tercatat.',
                    default => 'Interaksi berhasil dicatat.',
                };
            }

            $interaction->save();
        }

        return response()->json(['message' => $message]);
    }
}
