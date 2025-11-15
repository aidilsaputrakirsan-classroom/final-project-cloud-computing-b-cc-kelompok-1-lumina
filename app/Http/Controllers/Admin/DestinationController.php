<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Tampilkan daftar wisata (halaman admin).
     */
    public function index()
    {
        $categories   = Category::all();              // untuk navbar (layouts.app)
        $destinations = Destination::latest()->get(); // semua destinasi

        return view('admin.destinations.index', compact('categories', 'destinations'));
    }

    /**
     * Tampilkan form Tambah Wisata Baru.
     */
    public function create()
    {
        $categories = Category::all(); // untuk navbar (layouts.app)

        return view('admin.destinations.create', compact('categories'));
    }

    /**
     * Simpan data wisata baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',   // nama tempat
            'description' => 'required|string',           // deskripsi
            'location'    => 'required|string',           // link Google Maps
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // upload foto jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                                     ->store('destinations', 'public');
        }

        Destination::create($data);

        // setelah simpan, arahkan ke halaman publik /wisata
        return redirect()->route('wisata.index')
                         ->with('success', 'Wisata baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit wisata.
     */
    public function edit(Destination $destination)
    {
        $categories = Category::all(); // untuk navbar

        return view('admin.destinations.edit', compact('categories', 'destination'));
    }

    /**
     * Update data wisata.
     */
    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // kalau upload foto baru, hapus yang lama lalu simpan yang baru
        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }

            $data['image'] = $request->file('image')
                                     ->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Data wisata berhasil diperbarui.');
    }

    /**
     * Hapus data wisata.
     */
    public function destroy(Destination $destination)
    {
        // hapus file foto jika ada
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
                         ->with('success', 'Data wisata berhasil dihapus.');
    }
}
