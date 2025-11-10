{{-- resources/views/admin/categories/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori Baru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{ background:#f4f6f8; }
        .topbar{ background:#1f2a33; }
        .brand{ color:#ffd66e; font-weight:700; }
        .page-title{ font-weight:800; color:#1f2a33; }
        .card-form{ border:0; border-radius:12px; }
        .footer{ color:#6c757d; }
    </style>
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="topbar py-3 mb-4">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="brand">Jelajah Balikpapan</strong>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-light">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-warning" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3 class="page-title mb-4">Tambah Kategori Baru</h3>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <div class="card card-form">
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="mis. Sejarah Kolonial" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Opsional">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Aktif --}}
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-4 footer">
            © 2025 Jelajah Balikpapan - Developed by Lumina Team
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
