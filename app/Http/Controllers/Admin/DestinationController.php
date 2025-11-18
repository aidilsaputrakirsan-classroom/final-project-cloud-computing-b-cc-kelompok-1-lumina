<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $categories   = Category::all();
        $destinations = Destination::latest()->get();

        return view('admin.destinations.index', compact('categories', 'destinations'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.destinations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($data);

        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Wisata baru berhasil ditambahkan!');
    }

    public function edit(Destination $destination)
    {
        $categories = Category::all();
        return view('admin.destinations.edit', compact('categories', 'destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Data wisata berhasil diperbarui!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        // Selalu redirect ke dashboard admin!
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Data wisata berhasil dihapus!');
    }
}
