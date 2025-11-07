<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================
    // LOGIN & REGISTER
    // ===============================

    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Login gagal! Email atau password salah.',
        ]);
    }

    // Tampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')
                         ->with('status', 'Register sukses! Silakan login.');
    }

    // ===============================
    // USER PROFILE
    // ===============================

    // Tampilkan halaman profile
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    // Tampilkan form edit profile
    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    // Proses update profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender'      => 'nullable|string|max:20',
            'age'         => 'nullable|integer|min:0',
            'street_name' => 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'gender', 'age', 'street_name'));

        return redirect()->route('profile')
                         ->with('status', 'Profil berhasil diupdate!');
    }

    // ===============================
    // DASHBOARD ADMIN
    // ===============================

    public function dashboard()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang boleh masuk dashboard.');
        }

        return view('admin.dashboard');
    }

    // ===============================
    // SEJARAH
    // ===============================

    public function sejarah()
    {
        // Data berita sejarah
        $news = [
            [
                'title' => 'Berita Sejarah 1',
                'desc'  => 'Deskripsi berita sejarah pertama.',
                'img'   => 'https://images.unsplash.com/photo-1?fit=crop&w=600&q=80',
                'link'  => '#'
            ],
            [
                'title' => 'Berita Sejarah 2',
                'desc'  => 'Deskripsi berita sejarah kedua.',
                'img'   => 'https://images.unsplash.com/photo-2?fit=crop&w=600&q=80',
                'link'  => '#'
            ],
        ];

        // Render halaman sejarah dengan layout homepage
        return view('sejarah', compact('news'));
    }

    public function index()
    {
    // Misal ini homepage sama dengan sejarah
    $news = [
        [
            'title' => 'Berita Sejarah 1',
            'desc'  => 'Deskripsi berita sejarah pertama.',
            'img'   => 'https://images.unsplash.com/photo-1?fit=crop&w=600&q=80',
            'link'  => '#'
        ],
        [
            'title' => 'Berita Sejarah 2',
            'desc'  => 'Deskripsi berita sejarah kedua.',
            'img'   => 'https://images.unsplash.com/photo-2?fit=crop&w=600&q=80',
            'link'  => '#'
        ],
    ];

    return view('home', compact('news'));
    }

}
