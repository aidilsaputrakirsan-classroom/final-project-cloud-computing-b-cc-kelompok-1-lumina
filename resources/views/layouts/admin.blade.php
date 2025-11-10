<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jelajah Balikpapan - Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        :root { --navy: #153947; --gold: #ffd300;}
        body { background: #fcf9f4;}
        .topbar-admin {
            background: var(--navy); min-height: 64px;
            box-shadow: 0 2px 17px -13px #000;
        }
        .brand-title-admin {
            color: #ffd300; font-weight: bold; font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        .nav-link-admin {
            color: #fff !important; font-weight: 500;
            margin: 0 6px;
            transition: color .2s;
        }
        .nav-link-admin.active, .nav-link-admin:focus, .nav-link-admin:hover {
            color: #ffd300 !important;
        }
    </style>
</head>
<body>
    {{-- NAVBAR ADMIN --}}
    <nav class="topbar-admin d-flex align-items-center px-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('img/logo jelajah balikpapan.png') }}" height="38" width="38" style="object-fit:cover;border-radius:50%;">
                <span class="brand-title-admin ms-2">Jelajah Balikpapan</span>
            </div>
            <ul class="nav align-items-center mb-0">
                <li class="nav-item"><a class="nav-link nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link nav-link-admin {{ request()->routeIs('admin.histories.*') ? 'active' : '' }}" href="{{ route('admin.histories.index') }}">Sejarah</a></li>
                <li class="nav-item"><a class="nav-link nav-link-admin {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Kategori</a></li>
                <li class="nav-item"><a class="nav-link nav-link-admin {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a></li>
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </nav>
    <main class="container py-4">
        @yield('content')
    </main>
    <footer class="text-center py-4 text-muted bg-dark text-white">
        © 2025 Jelajah Balikpapan - Developed by Lumina Team
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
