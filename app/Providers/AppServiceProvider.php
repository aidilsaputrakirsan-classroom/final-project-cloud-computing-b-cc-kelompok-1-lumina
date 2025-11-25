<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event; // [BARU] Import Facade Event
use Illuminate\Auth\Events\Login;     // [BARU] Event Login
use Illuminate\Auth\Events\Logout;    // [BARU] Event Logout
use App\Listeners\LogUserLogin;       // [BARU] Listener Login
use App\Listeners\LogUserLogout;      // [BARU] Listener Logout
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Kodingan Lama: Membuat $categories selalu tersedia di semua view
        View::composer('*', function ($view) {
            $categories = Category::orderBy('name')->get();
            $view->with('categories', $categories);
        });

        // 2. Kodingan Baru: Mendaftarkan Pencatat Log (Activity Log)
        
        // Saat ada yang Login -> Jalankan LogUserLogin
        Event::listen(
            Login::class,
            LogUserLogin::class,
        );

        // Saat ada yang Logout -> Jalankan LogUserLogout
        Event::listen(
            Logout::class,
            LogUserLogout::class,
        );
    }
}