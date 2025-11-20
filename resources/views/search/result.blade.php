@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<style>
    .search-section {
        padding: 26px 22px 18px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(18,60,81,0.07);
        margin-bottom: 24px;
    }
    .search-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #18415a;
        margin-bottom: 7px;
        letter-spacing: 0.02em;
    }
    .highlighted {
        color: #ffba00;
        background: #fffbe6;
        padding: 0 2px;
        border-radius: 3px;
    }
    .search-list-group .list-group-item {
        border: 1.5px solid #f0f0f0 !important;
        border-radius: 14px !important;
        margin-bottom: 12px;
        box-shadow: 0 1px 7px rgba(18,60,81,0.03);
        transition: box-shadow .18s, border-color .18s;
    }
    .search-list-group .list-group-item:hover {
        border-color: #ffe082 !important;
        box-shadow: 0 8px 24px rgba(18,60,81,0.09);
        background: #fffef6 !important;
    }
</style>

<div class="container py-3">

    <h2 class="fw-bold mb-3">
        Hasil Pencarian untuk: <span class="highlighted">{{ $keyword ?? '' }}</span>
    </h2>

    @if(empty($keyword))
        <div class="alert alert-info mb-4">Masukkan kata kunci untuk mencari.</div>
    @endif

    <div class="row g-4">

        {{-- ========================= WISATA ========================= --}}
        <div class="col-12 col-lg-6">
            <div class="search-section h-100">
                <div class="search-title mb-2"><span style="color:#198754">🌴</span> Hasil Wisata</div>
                @if(isset($wisata) && $wisata->count())
                    <div class="list-group search-list-group">
                        @foreach($wisata as $item)
                        @php
                            $title = $item->nama_tempat ?? $item->name ?? $item->title ?? '—';
                            $excerpt = $item->deskripsi ?? $item->description ?? '';
                        @endphp
                        <a href="{{ url('/wisata/'.$item->slug) }}" class="list-group-item list-group-item-action py-3 px-3">
                            <div class="fw-bold mb-1" style="font-size:1.08rem;color:#18415a;">
                                {{ \Illuminate\Support\Str::limit($title, 50) }}
                            </div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($excerpt), 110) }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">Tidak ada hasil wisata.</p>
                @endif
            </div>
        </div>

        {{-- ========================= SEJARAH ========================= --}}
        <div class="col-12 col-lg-6">
            <div class="search-section h-100">
                <div class="search-title mb-2"><span style="color:#6f42c1">📜</span> Hasil Sejarah</div>
                @if(isset($sejarah) && $sejarah->count())
                    <div class="list-group search-list-group">
                        @foreach($sejarah as $item)
                        <a href="{{ url('/sejarah/'.$item->slug) }}" class="list-group-item list-group-item-action py-3 px-3">
                            <div class="fw-bold mb-1" style="font-size:1.08rem;color:#18415a;">
                                {{ \Illuminate\Support\Str::limit($item->title, 52) }}
                            </div>
                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 110) }}
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">Tidak ada hasil sejarah.</p>
                @endif
            </div>
        </div>

        {{-- ========================= CATEGORY ========================= --}}
        <div class="col-12">
            <div class="search-section">
                <div class="search-title mb-2"><span style="color:#0d6efd">🔖</span> Hasil Kategori</div>
                @if(isset($category) && $category->count())
                <div class="d-flex flex-wrap gap-2">
                    @foreach($category as $cat)
                    <a href="{{ url('/categories/'.$cat->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Tidak ada kategori yang sesuai.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
