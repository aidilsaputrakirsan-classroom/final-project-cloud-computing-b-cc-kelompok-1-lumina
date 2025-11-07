@extends('admin.layouts.app')

@section('title', 'Tambah Sejarah')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Sejarah Baru</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.histories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Sejarah</label>
                    <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Konten</label>
                    <textarea class="form-control" id="content" name="content" rows="7" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">-- Pilih kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="event_date" class="form-label">Tanggal Event</label>
                    <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date') }}">
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar (opsional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">Publikasikan Sejarah</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
