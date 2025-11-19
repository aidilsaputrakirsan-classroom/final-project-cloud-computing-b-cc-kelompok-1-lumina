<?php
// LOKASI: app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cek jika user adalah admin
        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin.');
        }

        // Ambil data untuk box di dashboard
        $sejarahTerbaru = History::latest()->take(5)->get();
        $totalSejarah = History::count();
        $totalKategori = Category::count(); // (Asumsi Anda punya Model Category)

        // Tampilkan view di Langkah 6
        return view('admin.dashboard', compact(
            'sejarahTerbaru',
            'totalSejarah',
            'totalKategori'
        ));
    }
}
