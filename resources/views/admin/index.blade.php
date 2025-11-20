@extends('layouts.app')

@section('title', 'Daftar Wisata')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Daftar Wisata</h2>
        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
            Tambah Wisata Baru
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Wisata</th>
                            <th>Link Google Maps</th>
                            <th>Deskripsi Singkat</th>
                            <th style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $d)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>
                                    @if($d->location)
                                        <a href="{{ $d->location }}" target="_blank">
                                            Lihat di Maps
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($d->description, 80) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.destinations.edit', $d->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.destinations.destroy', $d->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin mau hapus destinasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada destinasi wisata yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
