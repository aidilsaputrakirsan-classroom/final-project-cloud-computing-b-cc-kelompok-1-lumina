<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Category;

class SejarahController extends Controller
{
    // Daftar sejarah dengan filter kategori opsional
    public function index(Request $request)
    {
        $category_id = $request->query('category'); // optional filter
        $histories = History::with('category')
            ->where('is_published', true)
            ->when($category_id, fn($q) => $q->where('category_id', $category_id))
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('sejarah.index', compact('histories', 'category_id'));
    }

    // Detail sejarah berdasarkan slug
    public function show(History $history)
    {
        if (!$history->is_published) {
            abort(404);
        }
        $history->load('category');
        return view('sejarah.show', compact('history'));
    }

    // Halaman categories
    public function categories()
    {
        $categories = Category::with(['histories' => fn($q) => $q->where('is_published', true)->orderByDesc('published_at')])
            ->orderBy('name')
            ->get();

        return view('categories', compact('categories'));
    }
}
