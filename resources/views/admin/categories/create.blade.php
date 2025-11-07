@extends('admin.layouts.app')


@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-3">Tambah Kategori</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Icon (opsional)</label>
                    <input type="file" name="icon" class="form-control" accept="image/*">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label">Aktif</label>
                </div>
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
