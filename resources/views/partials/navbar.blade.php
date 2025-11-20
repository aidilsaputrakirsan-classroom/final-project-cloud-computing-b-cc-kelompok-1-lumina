<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">JelajahBalikpapan</a>

        {{-- Toggle mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                @guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('wisata.index') }}">Wisata</a>
    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sejarah.index') }}">Sejarah</a>
                    </li>

                    {{-- Dropdown Categories Dinamis --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            @foreach($categories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('sejarah.index', ['category' => $cat->id]) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-person-circle me-1"></i> Login
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wisata.index') }}">Wisata</a>
                    </li>

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
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link text-danger p-0 m-0" type="submit">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
