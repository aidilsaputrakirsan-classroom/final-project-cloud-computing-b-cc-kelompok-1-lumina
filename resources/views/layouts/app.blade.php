<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jelajah Balikpapan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background: #faf7f2;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }
        .navbar-custom {
            background: #123c51;
            box-shadow: 0 2px 16px rgba(18,60,81,0.07);
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.45rem;
            color: #ffe082 !important;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }
        .navbar-brand .logo-circle {
            background: #fff;
            border: 3px solid #ffe082;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            box-shadow: 0 2px 6px rgba(18,60,81,0.08);
            margin-right: 10px;
            overflow: hidden;
        }
        .navbar-brand .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .nav-link, .dropdown-item { color: #fff !important; font-weight: 500;}
        .nav-link:hover, .dropdown-item:hover { color: #ffe082 !important; }

        /* Search form */
        .search-form input {
            height: 32px;
            font-size: 0.85rem;
        }
        .search-form button {
            height: 32px;
            font-size: 0.85rem;
            padding: 0 10px;
        }

        .news-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.07);}
        .news-img { object-fit: cover; height: 200px; width: 100%; border-radius: 10px 10px 0 0;}
        .footer {
            background: #123c51;
            color: #fff;
            padding: 1.2rem 0;
            margin-top: 4rem;
            font-size: 1.1rem;
            letter-spacing: 1px;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
        }
        @media (max-width: 700px) {
            .navbar-brand { font-size:1.1rem; }
            .footer { font-size:.95rem;}
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom mb-2">
      <div class="container">
        <a class="navbar-brand" href="/">
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

            <!-- Search di kiri Home -->
            <li class="nav-item me-2">
              <form class="d-flex search-form" role="search">
                <input class="form-control rounded-pill me-1" type="search" placeholder="Ketik disini..." aria-label="Search">
                <button class="btn btn-warning rounded-pill" type="submit">Cari</button>
              </form>
            </li>

            <!-- Home -->
            <li class="nav-item me-3">
              <a class="nav-link" href="/">Home</a>
            </li>

            <!-- Categories -->
            <li class="nav-item dropdown me-2">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Categories
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Tokoh</a></li>
                <li><a class="dropdown-item" href="#">Peristiwa</a></li>
                <li><a class="dropdown-item" href="#">Tempat Bersejarah</a></li>
                <li><a class="dropdown-item" href="#">Budaya</a></li>
                <li><a class="dropdown-item" href="#">Ekonomi</a></li>
              </ul>
            </li>

            <!-- Sejarah -->
            <li class="nav-item me-2">
              <a class="nav-link" href="/sejarah">Sejarah</a>
            </li>

            <!-- Profile -->
            <li class="nav-item">
              <a class="nav-link" href="/profile">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffe082" class="bi bi-person-circle me-1 mb-1" viewBox="0 0 16 16">
                  <path d="M13.468 12.37C12.758 11.226 11.483 10.5 10 10.5c-1.483 0-2.758.726-3.468 1.87A6.97 6.97 0 0 0 8 15a6.97 6.97 0 0 0 5.468-2.63ZM8 9.5A3 3 0 1 0 8 3.5a3 3 0 0 0 0 6ZM8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1Zm0 13a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"/>
                </svg>
                Profile
              </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    {{-- Konten Halaman --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <div class="footer text-center">
        &copy; {{ date('Y') }} Jelajah Balikpapan - Developed by Lumina Team
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
