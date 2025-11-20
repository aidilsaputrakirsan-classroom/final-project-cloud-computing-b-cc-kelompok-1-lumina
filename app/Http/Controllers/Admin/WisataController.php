<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::latest()->paginate(10);
        return view('admin.wisatas.index', compact('wisatas'));
    }

    public function create()
    {
        return view('admin.wisatas.create');
    }

    public function store(Request $request)
    {
        // validasi sederhana
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:wisatas,slug',
            'description' => 'required|string',
        ]);

        Wisata::create($data);

        return redirect()->route('admin.wisatas.index')
                         ->with('success', 'Wisata baru berhasil ditambahkan.');
    }

    // edit/update/destroy bisa diteruskan nanti
}
