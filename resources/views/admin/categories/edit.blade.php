@extends('layouts.admin')

@section('title','Edit Kategori')

@section('content')
<h3 class="mb-3">Edit Kategori</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
      </div>

      <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktif</label>
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection
