<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Styling tambahan --}}
    <style>
        :root {
            --navy: #0c3a47;
            --cream: #f7f2ea;
        }
        body { background: var(--cream); }
        .topbar { background: var(--navy); }
        .brand-title { color: #ffd66e; font-weight: 700; font-size: 1.35rem; }
        .search-wrap { max-width: 320px; }
        .btn-search { background: #ffc107; color: #000; font-weight: 600; }
        .page-title { font-weight: 800; color: #143542; font-size: 3rem; }
        .subtitle { color: #6c7a80; }
        .stat-card {
            border: 0; color: #fff; border-radius: 14px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .08); height: 140px;
            display: flex; flex-direction: column; justify-content: center;
        }
        .grad-cyan { background: linear-gradient(135deg, #3ec7e0, #2aa6c1); }
        .grad-green { background: linear-gradient(135deg, #39d27d, #1e6fb9); }
        .grad-orange { background: linear-gradient(135deg, #ffb36b, #ff6b3d); }
        .grad-sand { background: linear-gradient(135deg, #e2c49d, #cfa477); }
        .stat-card h6 { text-transform: uppercase; opacity: .95; margin-bottom: .35rem; }
        .stat-card .big { font-size: 2rem; font-weight: 800; line-height: 1; }
        .card-link { color: #fff; text-decoration: underline; font-weight: 600; font-size: .95rem; }
        .btn-pill { border-radius: 999px; padding: .75rem 1.1rem; font-weight: 700; }
        .table-wrap { border-radius: 14px; overflow: hidden; box-shadow: 0 10px 18px rgba(0, 0, 0, .06); }
        .footer-bar { background: var(--navy); color: #fff; }
        .col-actions { width: 170px; }
        
        /* User Management Section */
        .user-stat-card {
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }
        .grad-blue { background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%); color: #0D47A1; }
        .grad-green-light { background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%); color: #1B5E20; }
        .grad-yellow { background: linear-gradient(135deg, #FFF9C4 0%, #FFF59D 100%); color: #E65100; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="topbar py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('img/logo jelajah balikpapan.png') }}" alt="logo" width="36" height="36" class="rounded-circle">
                <span class="brand-title">Jelajah Balikpapan</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <ul class="nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link text-white">Categories</a></li>
                    <li class="nav-item"><a href="{{ route('sejarah.index') }}" class="nav-link text-white">Sejarah</a></li>
                    <li class="nav-item"><a href="{{ route('profile') }}" class="nav-link text-white">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="container mt-5">
        <h1 class="page-title">Selamat datang, Admin!</h1>
        <p class="subtitle">
            Pantau dan kelola seluruh sejarah, kategori, dan destinasi wisata kota Balikpapan dengan mudah.
        </p>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- STAT CARDS --}}
        <div class="row g-4 mt-2">
            {{-- Total Sejarah --}}
            <div class="col-md-3">
                <div class="card stat-card grad-cyan">
                    <div class="px-4">
                        <h6>Total Sejarah</h6>
                        <div class="big">{{ $totalSejarah ?? 0 }}</div>
                        <a class="card-link mt-2 d-inline-block" href="{{ route('admin.histories.index') }}">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            {{-- Total Kategori --}}
            <div class="col-md-3">
                <div class="card stat-card grad-green">
                    <div class="px-4">
                        <h6>Total Kategori</h6>
                        <div class="big">{{ $totalKategori ?? 0 }}</div>
                        <a class="card-link mt-2 d-inline-block" href="{{ route('admin.categories.index') }}">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            {{-- TOTAL WISATA --}}
            <div class="col-md-3">
                <div class="card stat-card grad-orange">
                    <div class="px-4">
                        <h6>Total Wisata</h6>
                        <div class="big">{{ $totalWisata ?? 0 }}</div>
                        <a class="card-link mt-2 d-inline-block" href="{{ route('admin.destinations.index') }}">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kategori Aktif --}}
            <div class="col-md-3">
                <div class="card stat-card grad-sand">
                    <div class="px-4">
                        <h6>Kategori Aktif</h6>
                        <div class="big">{{ $kategoriAktif ?? 0 }}</div>
                        <span class="d-inline-block mt-2" style="opacity:.85">—</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="card action-card mt-4">
            <div class="card-body d-flex flex-wrap gap-3">
                <a href="{{ route('admin.histories.create') }}" class="btn btn-primary btn-pill">
                    Tambah Sejarah Baru
                </a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-pill">
                    Tambah Kategori Baru
                </a>
                <a href="{{ route('admin.destinations.create') }}" class="btn btn-warning btn-pill">
                    Tambah Wisata Baru
                </a>
            </div>
        </div>

        {{-- TABEL SEJARAH TERBARU --}}
        <div class="table-wrap mt-4">
            <div class="p-3 border-bottom bg-white">
                <strong>Sejarah Terbaru</strong>
            </div>
            <div class="table-responsive bg-white">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal Event</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($sejarahTerbaru ?? []) as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.histories.edit', $item->id) }}" class="text-decoration-none">
                                        {{ $item->title ?? '—' }}
                                    </a>
                                </td>
                                <td>{{ $item->category->name ?? '—' }}</td>
                                <td>
                                    {{ $item->event_date
                                        ? \Illuminate\Support\Carbon::parse($item->event_date)->translatedFormat('d M Y')
                                        : '—' }}
                                </td>
                                <td>
                                    @php
                                        $status = $item->status ?? ($item->is_published ? 'published' : 'draft');
                                        $badge = [
                                            'published' => 'success',
                                            'draft'     => 'secondary',
                                            'archived'  => 'warning',
                                        ][$status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td>{{ $item->created_at?->diffForHumans() ?? '—' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.histories.edit', $item->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.histories.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data sejarah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- USER MANAGEMENT SECTION --}}
        {{-- ========================================== --}}
        <div class="mt-5 mb-5">
            <h2 class="mb-4" style="font-weight: 700; color: #143542;">User Management</h2>
            
            {{-- User Statistics --}}
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="user-stat-card grad-blue">
                        <h6 class="mb-2">Total Account</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers ?? 0 }} account</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="user-stat-card grad-green-light">
                        <h6 class="mb-2">Total Admin</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalAdmin ?? 0 }} account</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="user-stat-card grad-yellow">
                        <h6 class="mb-2">Total User</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalRegularUsers ?? 0 }} account</h2>
                    </div>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <input type="text" 
                           id="searchInput"
                           class="form-control form-control-lg" 
                           placeholder="Search by name or email"
                           onkeyup="filterUsers()">
                </div>
            </div>

            {{-- Users Table --}}
            <div class="table-wrap">
                <div class="p-3 border-bottom bg-white">
                    <strong>All Users</strong>
                </div>
                <div class="table-responsive bg-white">
                    <table class="table mb-0 align-middle" id="usersTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="col-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($users ?? []) as $index => $user)
                            <tr class="user-row" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                        {{ $user->role ?? 'user' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.dashboard.deleteUser', $user->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus user ini?')"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>

                                        {{-- Edit Button --}}
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-warning" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editUserModal{{ $user->id }}">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.dashboard.updateUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Name</strong></label>
                                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Email</strong></label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Role</strong></label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Tidak ada data user</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- END USER MANAGEMENT SECTION --}}

    </section>

    {{-- FOOTER --}}
    <footer class="footer-bar mt-5">
        <div class="container py-3 text-center">
            © 2025 Jelajah Balikpapan - Developed by Lumina Team
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JavaScript untuk filter real-time --}}
    <script>
    function filterUsers() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const tableRows = document.querySelectorAll('.user-row');
        
        tableRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            
            if (name.includes(searchInput) || email.includes(searchInput)) {
                row.style.display = '';  // Tampilkan
            } else {
                row.style.display = 'none';  // Sembunyikan
            }
        });
    }
    </script>
</body>
</html>
