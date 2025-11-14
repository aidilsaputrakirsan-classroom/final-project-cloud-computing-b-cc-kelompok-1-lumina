<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Destination;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Statistik utama
        $totalSejarah   = History::count();
        $totalKategori  = Category::count();
        $totalWisata    = Destination::count();        // <- ini untuk "Total Wisata"
        $kategoriAktif  = $totalKategori;              // sesuaikan kalau punya flag is_active

        // Data sejarah terbaru untuk tabel bawah
        $sejarahTerbaru = History::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSejarah',
            'totalKategori',
            'totalWisata',
            'kategoriAktif',
            'sejarahTerbaru'
        ));
    }
}
