@extends('layouts.app')

@section('title', 'Tambah Wisata Baru')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Tambah Wisata Baru</h2>

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
            <form action="{{ route('admin.destinations.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- Nama Tempat --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Tempat</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Contoh: Pantai Manggar Segarasari"
                        value="{{ old('name') }}"
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
                        placeholder="Tuliskan deskripsi singkat tentang tempat wisata ini..."
                        required
                    >{{ old('description') }}</textarea>
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
                        placeholder="https://maps.google.com/..."
                        value="{{ old('location') }}"
                        required
                    >
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Salin URL dari Google Maps (menu “Bagikan” → “Salin link”).
                    </div>
                </div>

                {{-- Foto Wisata --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Foto Wisata</label>
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
                        Format: JPG, JPEG, PNG, atau WEBP (maks. 2 MB).
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Wisata
                    </button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
