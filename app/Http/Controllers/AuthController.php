<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * ===============================
     * LOGIN & REGISTER
     * ===============================
     */

    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login dengan redirect berdasarkan role
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role user
            if (auth()->user()->role === 'admin') {
                // Admin -> ke dashboard
                return redirect()->route('admin.dashboard')
                                ->with('success', 'Selamat datang, Admin!');
            } else {
                // Regular user -> ke halaman utama
                return redirect()->route('home')
                                ->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors([
            'email' => 'Login gagal! Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan form register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle register dengan default role = 'user'
     */
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
            'role'     => 'user', // Default role untuk user baru
        ]);

        return redirect()->route('login')
                        ->with('status', 'Register sukses! Silakan login.');
    }

    /**
     * ===============================
     * PROFILE MANAGEMENT
     * ===============================
     */

    /**
     * Tampilkan profil user
     */
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Tampilkan form edit profil
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    /**
     * Update profil user
     */
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

        $user->update($request->only(
            'name',
            'email',
            'gender',
            'age',
            'street_name'
        ));

        return redirect()->route('profile')
                        ->with('status', 'Profil berhasil diupdate!');
    }
}
