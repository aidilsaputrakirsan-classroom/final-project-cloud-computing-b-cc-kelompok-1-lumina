<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">SejarahKita</a>

        {{-- Tombol toggle (mobile view) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                {{-- ✅ Jika user belum login --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sejarah') }}">Sejarah</a>
                    </li>

                    {{-- Dropdown Categories --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Tokoh</a></li>
                            <li><a class="dropdown-item" href="#">Peristiwa</a></li>
                            <li><a class="dropdown-item" href="#">Tempat Bersejarah</a></li>
                            <li><a class="dropdown-item" href="#">Budaya</a></li>
                            <li><a class="dropdown-item" href="#">Ekonomi</a></li>
                        </ul>
                    </li>

                    {{-- Tombol Profile/Login --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                 fill="currentColor" class="bi bi-person-circle me-1 mb-1"
                                 viewBox="0 0 16 16">
                                <path d="M13.468 12.37C12.758 11.226 11.483 10.5 10
                                10.5c-1.483 0-2.758.726-3.468 1.87A6.97
                                6.97 0 0 0 8 15a6.97 6.97 0 0 0
                                5.468-2.63ZM8 9.5A3 3 0 1 0 8
                                3.5a3 3 0 0 0 0 6ZM8
                                1a7 7 0 1 1 0 14A7 7 0 0 1
                                8 1Zm0 13a6 6 0 1 0 0-12
                                6 6 0 0 0 0 12Z"/>
                            </svg>
                            Profile
                        </a>
                    </li>

                {{-- ✅ Jika user sudah login (baik user biasa atau admin) --}}
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle me-1"></i> Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
