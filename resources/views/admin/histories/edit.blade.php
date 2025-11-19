@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Sejarah: {{ $history->title }}</h2>

    <form action="{{ route('admin.histories.update', $history) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $history->title) }}" required>
        </div>

        <!-- Kategori -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $history->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
            <label for="image" class="form-label">Foto/Gambar</label>
            <input type="file" class="form-control" id="image" name="image">
            <small>Kosongkan jika tidak ingin ganti gambar.</small>
            @if($history->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $history->image) }}" alt="{{ $history->title }}" style="max-height: 150px;">
                </div>
            @endif
        </div>

        <!-- Konten -->
        <div class="mb-3">
            <label for="content" class="form-label">Artikel Bacaan</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $history->content) }}</textarea>
        </div>

        <!-- Tanggal Event -->
        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="event_date" name="event_date"
                value="{{ old('event_date', $history->event_date ? $history->event_date->format('Y-m-d') : '') }}" required>
        </div>

        <!-- Publikasi -->
        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                {{ old('is_published', $history->is_published) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">Publikasikan</label>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.histories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
