<?php

namespace App\Http\Controllers;

use App\Models\Hangout;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hangouts = Hangout::withCount('images')
            ->with(['location'])
            ->withAvg(['visitorRatings as average_rating'], 'rating_value')
            ->latest()
            ->take(5)
            ->get();


        $totalHangout = Hangout::count();
        $activeHangout = Hangout::where('status', 1)->count();
        $totalImages = Hangout::withCount('images')->get()->sum('images_count');

        $avgRatingAll = number_format(
            Hangout::withAvg(['visitorRatings as average_rating'], 'rating_value')
                ->get()
                ->avg('average_rating'),
            2
        );


        return view('admin.dashboard', compact(
            'hangouts',
            'totalHangout',
            'activeHangout',
            'totalImages',
            'avgRatingAll'
        ));
    }
}
