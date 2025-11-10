<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class SejarahController extends Controller
{
    // Untuk halaman daftar sejarah
    public function index()
    {
        $histories = History::where('is_published', 1)->orderByDesc('published_at')->get();
        return view('sejarah.index', compact('histories'));
    }

    // Untuk halaman detail sejarah
    public function show($slug)
    {
        // Ganti $slug jadi $id jika url-mu route pakai id
        $history = History::where('id', $slug)
            ->where('is_published', 1)
            ->firstOrFail();
        return view('sejarah.show', compact('history'));
    }
}
