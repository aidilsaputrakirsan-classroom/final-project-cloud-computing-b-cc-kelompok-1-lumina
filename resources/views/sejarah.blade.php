@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <h1 class="fw-bold display-4 mb-3 text-center" style="color:#1E2A36; letter-spacing:2px;">
        Info <span class="text-warning">Balikpapan</span>
    </h1>

    <!-- Filter Kategori -->
    <div class="mb-4 text-center">
        <a href="{{ route('sejarah.index') }}" class="btn btn-sm btn-outline-primary {{ empty($category_id) ? 'active' : '' }}">Semua</a>
        @foreach($categories as $cat)
            <a href="{{ route('sejarah.index', ['category' => $cat->id]) }}" class="btn btn-sm btn-outline-primary {{ (!empty($category_id) && $category_id == $cat->id) ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Daftar Sejarah -->
    <div class="row row-cols-1 row-cols-md-3 g-5 justify-content-center py-2">
        @forelse ($histories as $history)
            <div class="col d-flex flex-column align-items-center">
                <div class="bg-light border rounded-2 d-flex justify-content-center align-items-center mb-3" style="width:220px; height:220px;">
                    @if($history->image)
                        <img src="{{ asset('storage/'.$history->image) }}" class="img-fluid" alt="{{ $history->title }}" style="object-fit:cover; max-width:95%; max-height:95%;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </div>
                <h5 class="fw-semibold text-center mb-1" style="font-size:1.13rem;">
                    {{ $history->title }}
                </h5>
                <div class="text-center text-muted mb-2" style="font-size:.95rem;">
                    {{ $history->event_date ? $history->event_date->format('d M Y') : '-' }}
                </div>
                <a href="{{ route('sejarah.show', $history->slug) }}" class="btn btn-sm btn-outline-secondary rounded-1" style="min-width:95px;">Read more</a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Belum ada sejarah untuk kategori ini.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $histories->appends(request()->query())->links() }}
    </div>
</div>
@endsection
