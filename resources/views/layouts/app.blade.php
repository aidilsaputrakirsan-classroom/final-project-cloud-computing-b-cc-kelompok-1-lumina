<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sejarah Balikpapan')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        body { background: #faf7f2; font-family: 'Inter', Arial, Helvetica, sans-serif; }
        h1,h2,h3,h4,h5,h6,.navbar-brand { font-family: 'Inter', Arial, Helvetica, sans-serif; }
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
        .nav-link:hover, .dropdown-item:hover { color: #ffe082 !important; }

        /* Search box style */
        .search-form input { height: 36px; font-size: 0.9rem; padding-left: 14px; }
        .search-form button { height: 36px; font-size: 0.85rem; padding: 0 12px; }

        /* Autosuggest dropdown */
        #suggestionsList {
            max-height: 260px;
            overflow-y: auto;
            border-radius: 12px;
        }
        #suggestionsList .list-group-item:hover {
            background: #ffe082;
        }
        .suggest-type {
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 999px;
            margin-left: 8px;
            color: #fff;
        }
        .type-wisata { background: #198754; }
        .type-category { background: #0d6efd; }
        .type-sejarah { background: #6f42c1; }

        .footer {
            background: #123c51; color: #fff;
            padding: 1.2rem 0; margin-top: 4rem;
            font-size: 0.90rem; letter-spacing: 1px;
        }

        @media (max-width: 700px) {
            .navbar-brand { font-size:1.1rem; }
            .footer { font-size:.95rem; }
            .search-form input { width: 180px; }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom mb-2">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
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

                    {{-- SEARCH WITH AUTOSUGGEST --}}
                    <li class="nav-item me-2 position-relative" style="min-width: 260px;">
                        <!-- Form diarahkan ke route('search') supaya pencarian normal juga bekerja -->
                        <form class="d-flex search-form" action="{{ route('search') }}" method="GET" autocomplete="off" id="searchForm">
                            <input id="searchInput"
                                class="form-control rounded-pill me-1"
                                type="search"
                                name="query"
                                placeholder="Ketik disini..."
                                aria-label="Search" autocomplete="off">

                            <button class="btn btn-warning rounded-pill" type="submit">Cari</button>
                        </form>

                        <!-- Autosuggest dropdown -->
                        <ul id="suggestionsList"
                            class="list-group position-absolute w-100 shadow-sm"
                            style="top: 44px; z-index: 1000; display: none;">
                        </ul>
                    </li>

                    {{-- MENU --}}
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('wisata.index') }}">Wisata</a>
                    </li>

                    <li class="nav-item dropdown me-2">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('sejarah.index', ['category' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('sejarah.index') }}">Sejarah</a>
                    </li>

                    {{-- AUTH --}}
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Profile</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <div class="footer text-center">
        &copy; {{ date('Y') }} Jelajah Balikpapan - Developed by Lumina Team
    </div>


    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- AUTOSUGGEST JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const suggestionsList = document.getElementById('suggestionsList');
            const searchForm = document.getElementById('searchForm');

            let debounceTimer = null;

            // Function to render suggestions array
            function renderSuggestions(data) {
                suggestionsList.innerHTML = '';

                if (!data || data.length === 0) {
                    suggestionsList.style.display = 'none';
                    return;
                }

                data.forEach(item => {
                    // Tentukan URL berdasarkan tipe
                    let url = '#';
                    if (item.type === 'wisata') {
                        url = `/wisata/${item.slug}`;
                    } else if (item.type === 'category') {
                        url = `/category/${item.slug}`;
                    } else if (item.type === 'sejarah') {
                        url = `/sejarah/${item.slug}`;
                    }

                    const li = document.createElement('li');
                    li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    li.style.cursor = 'pointer';

                    // left: name, right: badge/type
                    li.innerHTML = `<div><strong>${escapeHtml(item.name)}</strong><div class="text-muted small">${escapeHtml(item.extra ?? '')}</div></div>
                                    <span class="suggest-type ${typeClass(item.type)}">${item.type}</span>`;

                    // klik hasil -> navigasi
                    li.addEventListener('click', function(e) {
                        window.location.href = url;
                    });

                    suggestionsList.appendChild(li);
                });

                suggestionsList.style.display = 'block';
            }

            // Simple escape to avoid XSS
            function escapeHtml(str) {
                if (!str) return '';
                return String(str).replace(/[&<>"'`=\/]/g, function(s) {
                    return ({
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#39;',
                        '/': '&#x2F;',
                        '`': '&#x60;',
                        '=': '&#x3D;'
                    })[s];
                });
            }

            function typeClass(type) {
                if (type === 'wisata') return 'type-wisata';
                if (type === 'category') return 'type-category';
                if (type === 'sejarah') return 'type-sejarah';
                return '';
            }

            // Fetch function
            function fetchSuggestions(q) {
                if (!q || q.length < 2) {
                    suggestionsList.style.display = 'none';
                    return;
                }

                // encode the query
                const url = `/search/autosuggest?query=${encodeURIComponent(q)}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        renderSuggestions(data);
                    })
                    .catch(err => {
                        console.error('Autosuggest error:', err);
                        suggestionsList.style.display = 'none';
                    });
            }

            // Debounced input handler
            searchInput.addEventListener('input', function(e) {
                const q = this.value.trim();

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    fetchSuggestions(q);
                }, 300);
            });

            // Close dropdown when clicking outside or pressing ESC
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsList.contains(e.target)) {
                    suggestionsList.style.display = 'none';
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    suggestionsList.style.display = 'none';
                }
            });

            // If user submits form (enter / click Cari) hide dropdown
            searchForm.addEventListener('submit', function() {
                suggestionsList.style.display = 'none';
            });

            // Optional: keyboard navigation (↑ ↓ Enter)
            (function addKeyboardNav() {
                let index = -1;
                searchInput.addEventListener('keydown', function(e) {
                    const items = suggestionsList.querySelectorAll('.list-group-item');
                    if (!items.length) return;

                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        index = Math.min(index + 1, items.length - 1);
                        highlight(items, index);
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        index = Math.max(index - 1, 0);
                        highlight(items, index);
                    } else if (e.key === 'Enter') {
                        const active = suggestionsList.querySelector('.active');
                        if (active) {
                            active.click();
                            e.preventDefault();
                        }
                    }
                });

                function highlight(items, idx) {
                    items.forEach(el => el.classList.remove('active'));
                    if (idx >= 0 && items[idx]) {
                        items[idx].classList.add('active');
                        items[idx].scrollIntoView({ block: 'nearest' });
                    }
                }
            })();

        });
    </script>

</body>
</html>
