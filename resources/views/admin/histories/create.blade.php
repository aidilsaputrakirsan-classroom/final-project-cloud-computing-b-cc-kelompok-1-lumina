@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Sejarah Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.histories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Foto/Gambar</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Artikel Bacaan</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
        </div>
        <div class="form-check form-switch mb-4">
         <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
            {{ old('is_published', false) ? 'checked' : '' }}>
         <label class="form-check-label" for="is_published">Publikasikan</label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.histories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
