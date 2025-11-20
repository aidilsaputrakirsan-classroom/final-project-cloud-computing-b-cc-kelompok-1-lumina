<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Supabase\CreateClient;

class UserController extends Controller
{
    protected $supabase;
    
    public function __construct()
    {
        $this->supabase = CreateClient(
            config('services.supabase.url'),
            config('services.supabase.key')
        );
    }
    
    /**
     * Display all users
     */
    public function index()
    {
        try {
            // Ambil semua users dari Supabase
            $response = $this->supabase
                ->from('users')
                ->select('*')
                ->order('created_at', ['ascending' => false])
                ->execute();
            
            $users = $response->data ?? [];
            
            // Hitung statistik
            $totalUsers = count($users);
            $totalAdmin = count(array_filter($users, fn($u) => isset($u->role) && $u->role === 'admin'));
            $totalRegularUsers = $totalUsers - $totalAdmin;
            
            return view('admin.users.index', compact(
                'users',
                'totalUsers',
                'totalAdmin',
                'totalRegularUsers'
            ));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data users: ' . $e->getMessage());
        }
    }
    
    /**
     * Search users by name or email
     */
    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        
        try {
            $response = $this->supabase
                ->from('users')
                ->select('*')
                ->or("name.ilike.%{$searchQuery}%,email.ilike.%{$searchQuery}%")
                ->execute();
            
            $users = $response->data ?? [];
            
            // Hitung statistik
            $totalUsers = count($users);
            $totalAdmin = count(array_filter($users, fn($u) => isset($u->role) && $u->role === 'admin'));
            $totalRegularUsers = $totalUsers - $totalAdmin;
            
            return view('admin.users.index', compact(
                'users',
                'totalUsers',
                'totalAdmin',
                'totalRegularUsers'
            ));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mencari user: ' . $e->getMessage());
        }
    }
    
    /**
     * Make user an admin
     */
    public function makeAdmin($userId)
    {
        try {
            $this->supabase
                ->from('users')
                ->update(['role' => 'admin'])
                ->eq('id', $userId)
                ->execute();
            
            return back()->with('success', 'User berhasil dijadikan admin');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah role: ' . $e->getMessage());
        }
    }
    
    /**
     * Update user data
     */
    public function update(Request $request, $userId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:user,admin',
        ]);
        
        try {
            $this->supabase
                ->from('users')
                ->update($validated)
                ->eq('id', $userId)
                ->execute();
            
            return back()->with('success', 'Data user berhasil diupdate');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update user: ' . $e->getMessage());
        }
    }
    
    /**
     * Delete user
     */
    public function destroy($userId)
    {
        try {
            // Pastikan tidak menghapus diri sendiri
            $currentUserId = session('user_id'); // Sesuaikan dengan session Anda
            
            if ($userId === $currentUserId) {
                return back()->with('error', 'Tidak bisa menghapus akun sendiri');
            }
            
            // Delete dari tabel users
            $this->supabase
                ->from('users')
                ->delete()
                ->eq('id', $userId)
                ->execute();
            
            // Jika ingin menghapus dari auth.users juga, gunakan Admin API
            $adminClient = CreateClient(
                config('services.supabase.url'),
                config('services.supabase.service_key')
            );
            
            $adminClient->auth->admin->deleteUser($userId);
            
            return back()->with('success', 'User berhasil dihapus');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
