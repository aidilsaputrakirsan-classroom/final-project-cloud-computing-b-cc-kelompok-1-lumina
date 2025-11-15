@extends('layouts.app')

@section('title', 'Edit Wisata')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Edit Wisata</h2>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan.</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.destinations.update', $destination->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Tempat --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Tempat</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $destination->name) }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        required
                    >{{ old('description', $destination->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Link Google Maps --}}
                <div class="mb-3">
                    <label for="location" class="form-label">Link Google Maps</label>
                    <input
                        type="url"
                        name="location"
                        id="location"
                        class="form-control @error('location') is-invalid @enderror"
                        value="{{ old('location', $destination->location) }}"
                        required
                    >
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Pastikan link berasal dari tombol “Bagikan” di Google Maps.
                    </div>
                </div>

                {{-- Foto Wisata --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Foto Wisata</label>

                    @if($destination->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$destination->image) }}"
                                 alt="Foto {{ $destination->name }}"
                                 style="max-width: 200px; border-radius: 8px;">
                        </div>
                    @endif

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Biarkan kosong jika tidak ingin mengganti foto.
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
