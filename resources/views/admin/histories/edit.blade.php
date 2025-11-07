@extends('layouts.app')


@section('title', 'Edit Sejarah')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Edit Sejarah</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.histories.update', $history) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $history->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Konten</label>
                            <textarea name="content" rows="6" class="form-control" required>{{ old('content', $history->content) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Gambar Lama</label><br>
                            @if($history->image)
                                <img src="{{ Storage::url($history->image) }}" style="max-width:150px;">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Ganti Gambar (opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $history->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Event</label>
                            <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $history->event_date) }}">
                        </div>
                        <div class="mb-3">
                            <label>Lokasi</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $history->location) }}">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1"
                                {{ old('is_published', $history->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label">Terbitkan</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
