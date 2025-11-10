@extends('layouts.admin')

@section('title','Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Kategori</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Tambah Kategori Baru</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0 align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $cat)
          <tr>
            <td>{{ $loop->iteration + ($categories->currentPage()-1)*$categories->perPage() }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->slug }}</td>
            <td>
              <span class="badge bg-{{ $cat->is_active ? 'success':'secondary' }}">
                {{ $cat->is_active ? 'Aktif':'Nonaktif' }}
              </span>
            </td>
            <td>{{ $cat->created_at?->format('d M Y') }}</td>
            <td class="d-flex gap-2">
              <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">Belum ada kategori.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="mt-3">
    {{ $categories->links() }}
</div>
@endsection
