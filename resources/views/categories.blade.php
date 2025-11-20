@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Kategori Sejarah Balikpapan</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse($categories as $category)
            <div class="col">
                <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                    <h2 class="fw-bold mb-3">{{ $category->name }}</h2>
                    <ul class="list-unstyled">
                        @forelse($category->histories as $history)
                            <li class="mb-2">
                                <a href="{{ route('sejarah.show', $history->slug) }}">
                                    {{ $history->title }}
                                </a>
                            </li>
                        @empty
                            <li class="text-muted">Belum ada sejarah untuk kategori ini.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Belum ada kategori.
            </div>
        @endforelse
    </div>
</div>
@endsection
