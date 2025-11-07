@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-3">
    <div class="row align-items-center mb-4">
        <div class="col-lg-8">
            <h1 class="display-5 fw-bold mt-2" style="color:#123c51">
                <span class="me-2"><i class="fa fa-chart-line text-primary"></i></span>
                Selamat datang, Admin!
            </h1>
            <div class="h6 text-muted">Pantau dan kelola seluruh sejarah & kategori kota Balikpapan dengan mudah.</div>
        </div>
        <div class="col-lg-4 text-end">
            <img src="{{ asset('img/logo jelajah balikpapan.png') }}" alt="Logo" class="img-fluid" style="height:80px;">
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Statistic Cards Modern -->
        <div class="col-md-3">
            <div class="card border-0 shadow h-100" style="background:linear-gradient(90deg,#2193b0,#6dd5ed);color:#fff;">
                <div class="card-body d-flex align-items-center px-3">
                    <div><i class="fa fa-book fa-2x me-3"></i></div>
                    <div>
                        <div class="fs-6 fw-bold">Total Sejarah</div>
                        <div class="fs-3 fw-bold">{{ $total_histories }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.histories.index') }}" class="card-footer text-white text-decoration-none bg-transparent border-0 fs-6">
                    Lihat Semua <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow h-100" style="background:linear-gradient(90deg,#43cea2,#185a9d);color:#fff;">
                <div class="card-body d-flex align-items-center px-3">
                    <div><i class="fa fa-folder fa-2x me-3"></i></div>
                    <div>
                        <div class="fs-6 fw-bold">Total Kategori</div>
                        <div class="fs-3 fw-bold">{{ $total_categories }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="card-footer text-white text-decoration-none bg-transparent border-0 fs-6">
                    Lihat Semua <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow h-100" style="background:linear-gradient(90deg,#fdc830,#f37335);color:#fff;">
                <div class="card-body d-flex align-items-center px-3">
                    <div><i class="fa fa-check-circle fa-2x me-3"></i></div>
                    <div>
                        <div class="fs-6 fw-bold">Dipublikasi</div>
                        <div class="fs-3 fw-bold">{{ $published_histories }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow h-100" style="background:linear-gradient(90deg,#eacda3,#d6ae7b);color:#fff;">
                <div class="card-body d-flex align-items-center px-3">
                    <div><i class="fa fa-star fa-2x me-3"></i></div>
                    <div>
                        <div class="fs-6 fw-bold">Kategori Aktif</div>
                        <div class="fs-3 fw-bold">{{ $active_categories }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="row mb-4">
        <div class="col-md-7 mb-3">
            <div class="card shadow border-0">
                <div class="card-body d-flex gap-3 flex-wrap align-items-center bg-light rounded">
                    <a href="{{ route('admin.histories.create') }}" class="btn btn-lg btn-primary rounded-pill shadow-sm">
                        <i class="fa fa-plus"></i> Tambah Sejarah Baru
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-success rounded-pill shadow-sm">
                        <i class="fa fa-plus"></i> Tambah Kategori Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-5 d-flex flex-column justify-content-end align-items-end">
            <div class="alert alert-info border-0 shadow-sm mb-0">
                <i class="fa fa-lightbulb me-1"></i> Tips: Data statistik real-time & update otomatis!
            </div>
        </div>
    </div>

    <!-- Recent Histories -->
    <div class="card shadow border-0 mb-5">
        <div class="card-header bg-white py-3 fw-bold fs-5">
            <i class="fa fa-timeline me-1 text-primary"></i> Sejarah Terbaru
        </div>
        <div class="card-body table-responsive py-0">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Event</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_histories as $history)
                        <tr>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->category->name }}</td>
                            <td>{{ $history->event_date ? $history->event_date->format('d M Y') : '-' }}</td>
                            <td>
                                @if($history->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $history->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data sejarah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
