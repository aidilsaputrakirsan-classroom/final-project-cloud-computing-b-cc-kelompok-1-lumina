@extends('layouts.admin')
@section('title', 'Daftar Kategori')
@push('styles')
<style>
    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(24,60,81,0.09);
        border: none;
        max-width: 900px;
        margin: 0 auto 2.5rem auto;
    }
    .admin-header-wrap {
        max-width: 900px;
        margin: 0 auto 18px auto;
        display: flex; justify-content: space-between; align-items: center;
    }
    .btn-tambah-kategori {
        font-size: 1.01rem !important;
        padding: 8px 22px;
        border-radius: 9px;
        font-weight: 600;
        box-shadow: none !important;
    }
    .admin-table th, .admin-table td {
        vertical-align: middle !important;
    }
    .admin-table thead th {
        background: #f7fafc;
        color: #143542;
        font-weight: 700;
    }
    .admin-table tbody tr:hover {
        background: #eef6ff;
    }
    .badge.bg-success { background: #22b671 !important; }
    .badge.bg-secondary { background: #898fa6 !important; }
    .btn-warning.btn-sm {
        background: #ffe082; color: #7a5d16; font-weight: 600; border: none;
    }
    .btn-warning.btn-sm:hover { background: #ffce52; color: #4d3a07; }
    .btn-danger.btn-sm { background: #ffb8b8; color: #8b2222; font-weight: 600; border: none;}
    .btn-danger.btn-sm:hover { background: #ff5e5e; color: #fff;}
    .alert-success { border-radius: 12px; font-size: 1.04rem; max-width:900px; margin:0 auto 16px;}
    h2.card-title-section { font-weight: 700; color: #15458d; letter-spacing:.5px;}
    /* Lebarkan kolom aksi */
    .admin-table th.aksi-col, .admin-table td.aksi-col {
        width: 155px;
    }
    .aksi-btn-group { display: flex; gap: 6px; justify-content: center; }
    @media(max-width:1000px) {
        .admin-card, .admin-header-wrap { max-width: 100vw;}
    }
    @media(max-width:650px){
        .admin-table th, .admin-table td { font-size: .93rem; }
        .admin-header-wrap { flex-direction:column; gap:10px; align-items:stretch;}
    }
</style>
@endpush

@section('content')
<div class="container mt-3 px-0">
    <div class="admin-header-wrap">
        <h2 class="card-title-section mb-0">📚 Daftar Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-tambah-kategori">
            Tambah Kategori
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card admin-card">
        <div class="card-body pb-2">
            <div class="table-responsive">
                <table class="table table-striped table-bordered admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th class="aksi-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td><span class="text-muted small">{{ $category->slug }}</span></td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                @if ($category->is_active)
                                    <span class="badge bg-success px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td class="aksi-col">
                                <div class="aksi-btn-group">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm px-2">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-2" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
