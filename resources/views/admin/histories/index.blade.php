@extends('layouts.admin')

@push('styles')
<style>
    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(24,60,81,0.09);
        border: none;
        max-width: 980px;
        margin: 0 auto 2.5rem auto;
    }
    .admin-header-wrap {
        max-width: 980px;
        margin: 0 auto 18px auto;
        display: flex; justify-content: space-between; align-items: center;
    }
    .btn-tambah-sejarah {
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
    .aksi-col { width: 150px; }
    .aksi-btn-group { display: flex; gap: 8px; justify-content: center; }
    .btn-warning.btn-sm { background: #ffe082; color: #7a5d16; font-weight: 600; border: none;}
    .btn-warning.btn-sm:hover { background: #ffce52; color: #4d3a07; }
    .btn-danger.btn-sm { background: #ffb8b8; color: #8b2222; font-weight: 600; border: none;}
    .btn-danger.btn-sm:hover { background: #ff5e5e; color: #fff;}
    .alert-success { border-radius: 12px; font-size: 1.04rem; max-width:980px; margin:0 auto 16px;}
    h2.card-title-section { font-weight: 700; color: #15458d; letter-spacing:.5px;}
    @media(max-width:1100px) {
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
    <div class="admin-header-wrap mb-2">
        <h2 class="card-title-section mb-0">📜 Daftar Sejarah</h2>
        <a href="{{ route('admin.histories.create') }}" class="btn btn-primary btn-tambah-sejarah">
            Tambah Sejarah
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle admin-table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal Event</th>
                            <th class="aksi-col text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                        <tr>
                            <td class="fw-semibold">{{ $history->title }}</td>
                            <td>{{ $history->category->name ?? '-' }}</td>
                            <td>{{ $history->event_date ? $history->event_date->format('d M Y') : '-' }}</td>
                            <td class="aksi-col text-center">
                                <div class="aksi-btn-group">
                                    <a href="{{ route('admin.histories.edit', $history) }}" class="btn btn-warning btn-sm px-2" title="Edit Sejarah">Edit</a>
                                    <form action="{{ route('admin.histories.destroy', $history) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-2" title="Hapus Sejarah">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data sejarah.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $histories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
