@extends('layouts.app')


@section('title', 'Manajemen Sejarah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Daftar Sejarah</h1>
        <a href="{{ route('admin.histories.create') }}" class="btn btn-primary">+ Sejarah Baru</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($histories as $key => $history)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->category->name }}</td>
                            <td>{{ $history->event_date ? $history->event_date->format('d-m-Y') : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $history->is_published ? 'success' : 'secondary' }}">
                                    {{ $history->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.histories.edit', $history) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.histories.destroy', $history) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada sejarah.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
