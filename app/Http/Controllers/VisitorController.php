<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::withCount([
            'interactions as views_count' => fn($q) => $q->where('interaction_type', 'view'),
            'interactions as likes_count' => fn($q) => $q->where('interaction_type', 'like'),
            'interactions as bookmarks_count' => fn($q) => $q->where('interaction_type', 'bookmark'),
            'interactions as shares_count' => fn($q) => $q->where('interaction_type', 'share'),
            'interactions as ratings_count' => fn($q) => $q->where('interaction_type', 'rating'),
        ])
            ->join('visitor_interactions', 'visitors.id', '=', 'visitor_interactions.visitor_id')
            ->with(['interactions.hangout'])
            ->latest()
            ->get();

        return view('admin.visitors.index', compact('visitors'));
    }
}
