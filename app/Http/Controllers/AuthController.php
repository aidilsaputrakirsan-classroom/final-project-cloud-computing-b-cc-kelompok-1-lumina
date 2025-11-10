<?php

namespace App\Http\Controllers; // <-- Namespace sudah benar

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================
    // LOGIN & REGISTER
    // ===============================

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ===================================
            // PERBAIKAN: Arahkan ke dashboard admin
            // ===================================
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Login gagal! Email atau password salah.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

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
    // PERBAIKAN: Mengembalikan Fungsi Profile
    // ===============================

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

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
}
