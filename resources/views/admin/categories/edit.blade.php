@extends('layouts.app')


@section('title', 'Edit Kategori')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Edit Kategori</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Icon Lama</label><br>
                    @if($category->icon)
                        <img src="{{ Storage::url($category->icon) }}" style="max-width:80px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label>Ganti Icon (opsional)</label>
                    <input type="file" name="icon" class="form-control" accept="image/*">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label">Aktif</label>
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
