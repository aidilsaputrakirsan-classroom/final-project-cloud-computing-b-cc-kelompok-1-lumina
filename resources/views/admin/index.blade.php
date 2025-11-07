@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Sejarah</h2>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary mb-3">Tambah Sejarah</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinations as $d)
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->location }}</td>
                    <td>
                        @if($d->image)
                            <img src="{{ asset('storage/'.$d->image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.destinations.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.destinations.destroy', $d->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
