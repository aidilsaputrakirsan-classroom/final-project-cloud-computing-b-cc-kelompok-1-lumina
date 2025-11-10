@extends('layouts.admin') @section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Sejarah</h2>
        <a href="{{ route('admin.histories.create') }}" class="btn btn-primary">Tambah Baru</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal Event</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($histories as $history)
                <tr>
                    <td>{{ $history->title }}</td>
                    <td>{{ $history->event_date->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.histories.edit', $history) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.histories.destroy', $history) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data sejarah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
