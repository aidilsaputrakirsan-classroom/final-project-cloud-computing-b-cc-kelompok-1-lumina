<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jelajah Balikpapan - Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body { background: #fcf9f4;}
        .navbar-custom { background: #123c51; box-shadow: 0 2px 16px rgba(18,60,81,0.07); }
        .navbar-brand { font-weight: 800; font-size: 1.45rem; color: #ffe082 !important; letter-spacing: 1px; display: flex; align-items: center; }
        .navbar-brand .logo-circle {
            background: #fff; border: 3px solid #ffe082; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            width: 42px; height: 42px;
            box-shadow: 0 2px 6px rgba(18,60,81,0.08);
            margin-right: 10px; overflow: hidden;
        }
        .navbar-brand .logo-circle img { width: 100%; height: 100%; object-fit: cover; }
        .nav-link, .dropdown-item { color: #fff !important; font-weight: 500; }
        .nav-link.active, .nav-link:focus, .nav-link:hover { color: #ffe082 !important; }
        .dropdown-menu-dark .dropdown-item.active,
        .dropdown-menu-dark .dropdown-item:active,
        .dropdown-menu-dark .dropdown-item:hover {
            color: #ffe082;
            background-color: #123c51;
        }
        .footer { background: #123c51; color: #fff; padding: 1.2rem 0; margin-top: 4rem; font-size: 0.90rem; letter-spacing: 1px;}
        @media (max-width: 700px) {
            .navbar-brand { font-size:1.1rem; }
            .footer { font-size:.95rem; }
        }
    </style>
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom mb-2">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <span class="logo-circle">
                    <img src="{{ asset('img/logo jelajah balikpapan.png') }}" alt="Logo">
                </span>
                Jelajah Balikpapan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">

                    {{-- HOME --}}
                    <li class="nav-item me-3">
                        <a class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    {{-- WISATA --}}
                    <li class="nav-item me-3">
                        <a class="nav-link{{ request()->routeIs('admin.destinations.*') ? ' active' : '' }}" href="{{ route('admin.destinations.index') }}">Wisata</a>
                    </li>

                    {{-- KATEGORI --}}
                    <li class="nav-item me-3">
                        <a class="nav-link{{ request()->routeIs('admin.categories.*') ? ' active' : '' }}" href="{{ route('admin.categories.index') }}">Kategori</a>
                    </li>

                    {{-- SEJARAH --}}
                    <li class="nav-item me-3">
                        <a class="nav-link{{ request()->routeIs('admin.histories.*') ? ' active' : '' }}" href="{{ route('admin.histories.index') }}">Sejarah</a>
                    </li>

                    {{-- PROFILE --}}
                    @auth
                    <li class="nav-item me-2">
                        <a class="nav-link{{ request()->routeIs('profile') ? ' active' : '' }}" href="{{ route('profile') }}">Profile</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main class="container py-4">
        @yield('content')
    </main>
    <div class="footer text-center">
        &copy; {{ date('Y') }} Jelajah Balikpapan - Developed by Lumina Team
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
