@extends('layouts.admin')
@section('title', 'Daftar Wisata')
@push('styles')
<style>
    /* CARD LAYOUT */
    .admin-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(24,60,81,0.09);
        border: none;
        max-width: 1040px;
        margin: 0 auto 2.5rem auto;
    }
    .admin-table th, .admin-table td {
        vertical-align: middle !important;
    }
    .admin-table thead th {
        background: #f7fafc;
        color: #143542;
        font-weight: 700;
        font-size: 1.06rem;
    }
    .admin-table tbody tr:hover {
        background: #eef6ff;
    }
    .admin-table img {
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(40,70,100,0.07);
    }
    .btn-warning.btn-sm {
        background: #ffe082;
        color: #7a5d16;
        font-weight: 600;
        border: none;
    }
    .btn-warning.btn-sm:hover {
        background: #ffce52; color: #4d3a07;
    }
    .btn-danger.btn-sm {
        background: #ffb8b8;
        color: #8b2222;
        font-weight: 600;
        border: none;
    }
    .btn-danger.btn-sm:hover {
        background: #ff5e5e; color: #fff;
    }
    .card-title-section { font-weight: 700; color: #15458d; letter-spacing:.5px;}
    .admin-header-wrap {
        max-width: 1040px;
        margin: 0 auto 10px auto;
        display: flex; justify-content: space-between; align-items: center;
    }
    .btn-tambah-wisata {
        font-size: 1.025rem !important;
        padding: 9px 24px;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: none !important;
    }
    .alert-success {
        border-radius: 12px; font-size: 1.04rem; max-width:1040px; margin:0 auto 16px;
        box-shadow: 0 2px 9px rgba(24,60,81,0.05);
    }
    @media(max-width:1100px) {
        .admin-card, .admin-header-wrap { max-width: 100vw;}
    }
    @media(max-width:650px){
        .admin-table th, .admin-table td { font-size: .93rem; }
        .admin-header-wrap { flex-direction:column; gap:12px; align-items:stretch;}
    }
</style>
@endpush

@section('content')
<div class="container mt-3 px-0">
    <div class="admin-header-wrap mb-2">
        <h2 class="card-title-section mb-0">🗺️ Daftar Wisata</h2>
        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary btn-tambah-wisata">
            Tambah Wisata
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card admin-card">
        <div class="card-body pb-1">
            <div class="table-responsive">
                <table class="table table-bordered admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Wisata</th>
                            <th>Link Google Maps</th>
                            <th>Deskripsi Singkat</th>
                            <th style="width: 144px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $d)
                        <tr>
                            <td>
                                @if($d->image)
                                    <img src="{{ asset('storage/'.$d->image) }}"
                                         alt="Foto {{ $d->name }}"
                                         width="70" height="70"
                                         style="object-fit:cover;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $d->name }}</td>
                            <td>
                                @if($d->location)
                                    <a href="{{ $d->location }}" target="_blank" class="text-decoration-underline" rel="noopener">
                                        Lihat di Maps
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($d->description, 80) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.destinations.edit', $d->id) }}" class="btn btn-warning btn-sm px-3">Edit</a>
                                    <form action="{{ route('admin.destinations.destroy', $d->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin mau hapus destinasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-3">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada destinasi wisata yang tersimpan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
