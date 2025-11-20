<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

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
        $totalWisata    = Destination::count();
        $kategoriAktif  = $totalKategori;

        // Data sejarah terbaru untuk tabel bawah
        $sejarahTerbaru = History::latest()->take(5)->get();

        // TAMBAHAN: Data users - SELALU tampilkan semua
        $users = User::orderBy('created_at', 'desc')->get();
        
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalRegularUsers = $totalUsers - $totalAdmin;

        return view('admin.dashboard', compact(
            'totalSejarah',
            'totalKategori',
            'totalWisata',
            'kategoriAktif',
            'sejarahTerbaru',
            'users',
            'totalUsers',
            'totalAdmin',
            'totalRegularUsers'
        ));
    }

    /**
     * Jadikan user sebagai admin
     */
    public function makeAdmin($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->role = 'admin';
            $user->save();

            return redirect()->route('admin.dashboard')->with('success', 'User berhasil dijadikan admin');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update role: ' . $e->getMessage());
        }
    }

    /**
     * Update data user
     */
    public function updateUser(Request $request, $userId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'role' => 'required|in:user,admin',
        ]);

        try {
            $user = User::findOrFail($userId);
            $user->update($validated);

            return redirect()->route('admin.dashboard')->with('success', 'Data user berhasil diupdate');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update user: ' . $e->getMessage());
        }
    }

    /**
     * Hapus user
     */
    public function deleteUser($userId)
    {
        try {
            $user = User::findOrFail($userId);
            
            // Jangan hapus diri sendiri
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Tidak bisa menghapus akun sendiri');
            }

            $user->delete();

            return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal hapus user: ' . $e->getMessage());
        }
    }
}
