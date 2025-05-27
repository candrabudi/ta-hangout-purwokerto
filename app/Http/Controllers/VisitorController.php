<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $page = max((int) $request->get('page', 1), 1);
        $offset = ($page - 1) * $perPage;

        $totalVisitors = Visitor::count();
        $totalPages = (int) ceil($totalVisitors / $perPage);

        $visitors = Visitor::withCount([
            'interactions as views_count' => fn($q) => $q->where('interaction_type', 'view'),
            'interactions as likes_count' => fn($q) => $q->where('interaction_type', 'like'),
            'interactions as bookmarks_count' => fn($q) => $q->where('interaction_type', 'bookmark'),
            'interactions as shares_count' => fn($q) => $q->where('interaction_type', 'share'),
            'interactions as ratings_count' => fn($q) => $q->where('interaction_type', 'rating'),
        ])
            ->with(['interactions.hangout'])
            ->latest()
            ->skip($offset)
            ->take($perPage)
            ->get();

        return view('admin.visitors.index', compact(
            'visitors',
            'perPage',
            'page',
            'totalPages'
        ));
    }


}
