<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;

class DashboardController extends Controller
{
    public function index()
    {
        $total_histories = History::count();
        $total_categories = Category::count();
        $published_histories = History::where('is_published', true)->count();
        $active_categories = Category::where('is_active', true)->count();

        $recent_histories = History::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_histories',
            'total_categories',
            'published_histories',
            'active_categories',
            'recent_histories'
        ));
    }
}
