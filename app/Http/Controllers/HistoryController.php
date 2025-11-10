<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    /**
     * (READ) Menampilkan daftar sejarah (admin)
     */
    public function index()
    {
        $histories = History::orderByDesc('created_at')->get();
        return view('admin.histories.index', compact('histories'));
    }

    /**
     * (READ) Menampilkan daftar sejarah (publik)
     */
    public function publicIndex()
    {
        $histories = History::where('is_published', 1)->latest('published_at')->get();
        return view('sejarah.index', compact('histories'));
    }

    /**
     * (CREATE - Form) Menampilkan form tambah baru
     */
    public function create()
    {
        return view('admin.histories.create');
    }

    /**
     * (CREATE - Store) Menyimpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'event_date' => 'required|date',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('photos', 'public');
            $validated['image'] = $path;
        }

        // Pastikan status publish & published_at bisa tersimpan
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        History::create($validated);
        return redirect()->route('admin.histories.index')->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    /**
     * (UPDATE - Form) Menampilkan form edit
     */
    public function edit(History $history)
    {
        return view('admin.histories.edit', compact('history'));
    }

    /**
     * (UPDATE - Store) Memperbarui data
     */
    public function update(Request $request, History $history)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'event_date' => 'required|date',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $path = $request->file('image')->store('photos', 'public');
            $validated['image'] = $path;
        }

        // Pastikan status publish & published_at bisa tersimpan
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['is_published'] ? ($history->published_at ?: now()) : null;

        $history->update($validated);
        return redirect()->route('admin.histories.index')->with('success', 'Data sejarah berhasil diperbarui.');
    }

    /**
     * (DELETE) Menghapus data
     */
    public function destroy(History $history)
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }
        $history->delete();
        return redirect()->route('admin.histories.index')->with('success', 'Data sejarah berhasil dihapus.');
    }
}
