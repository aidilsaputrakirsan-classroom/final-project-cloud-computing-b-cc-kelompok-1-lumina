@extends('layouts.app')

@section('title', 'Wisata Balikpapan')

@section('content')
<style>
    /* Area khusus halaman wisata */
    .wisata-page {
        padding: 24px 0 40px;
    }

    .wisata-section {
        background: #ffffff;
        border-radius: 18px;
        padding: 28px 28px 36px;
        box-shadow: 0 16px 32px rgba(12, 33, 45, 0.12);
    }

    .wisata-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: .14em;
        color: #8c9aa2;
        margin-bottom: 4px;
    }

    .wisata-title {
        font-weight: 800;
        font-size: 2rem;
        color: #14252f;
        margin-bottom: 4px;
    }

    /* dibikin penuh, tidak dibatasi max-width lagi */
    .wisata-subtitle {
        color: #6a7a80;
        font-size: 0.95rem;
        /* max-width: 520px;  <-- DIHAPUS */
    }

    .wisata-grid {
        margin-top: 24px;
    }

    .wisata-card {
        border-radius: 16px;
        border: 1px solid #e2e7ea;
        overflow: hidden;
        background: #f8fbfd;
        box-shadow: 0 6px 16px rgba(10, 35, 50, 0.08);
        transition: transform .25s ease, box-shadow .25s ease, background .25s ease, border-color .25s ease;
        height: 100%;
    }

    .wisata-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 30px rgba(10, 35, 50, 0.18);
        background: #ffffff;
        border-color: #c1d2dd;
    }

    .wisata-card-img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .wisata-card-body {
        padding: 16px 18px 18px;
    }

    .wisata-meta {
        font-size: 0.78rem;
        color: #9aa6ac;
        margin-bottom: 4px;
    }

    .wisata-name {
        font-weight: 700;
        font-size: 1.02rem;
        color: #233540;
        margin-bottom: 6px;
    }

    .wisata-desc {
        font-size: 0.9rem;
        color: #5f6c71;
        min-height: 40px;
    }

    .wisata-link {
        margin-top: 12px;
        font-size: 0.86rem;
        font-weight: 600;
        color: #0f6e9b;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .wisata-link:hover {
        color: #0a4a6a;
        text-decoration: underline;
    }

    .wisata-link-icon {
        font-size: 1rem;
        line-height: 1;
    }

    /* Kartu kosong ketika tidak ada gambar */
    .wisata-card-placeholder {
        background: #e3edf5;
        height: 190px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f6472;
        font-size: .9rem;
        font-weight: 600;
    }

    /* Pagination */
    .wisata-pagination .pagination {
        margin-bottom: 0;
    }

    .wisata-pagination .page-link {
        border-radius: 999px !important;
        padding: 6px 11px;
        font-size: 0.85rem;
        color: #35525b;
    }

    .wisata-pagination .page-item.active .page-link {
        background: #0f6e9b;
        border-color: #0f6e9b;
        color: #fff;
    }

    @media (max-width: 768px) {
        .wisata-section {
            padding: 22px 16px 28px;
        }
        .wisata-title {
            font-size: 1.6rem;
        }
    }
</style>

<div class="wisata-page">
    <div class="container">
        <div class="wisata-section">
            {{-- Header section: tanpa total destinasi, teks lebar penuh --}}
            <div>
                <div class="wisata-label">Destinasi</div>
                <h1 class="wisata-title">Wisata Balikpapan</h1>
                <p class="wisata-subtitle mb-0">
                    Jelajahi berbagai destinasi wisata menarik di Kota Balikpapan, mulai dari pantai, ruang terbuka hijau, hingga objek wisata keluarga dan edukasi.
                </p>
            </div>

            {{-- Grid kartu wisata --}}
            @if($destinations->count())
                <div class="row row-cols-1 row-cols-md-3 g-3 wisata-grid">
                    @foreach($destinations as $d)
                        <div class="col">
                            <div class="card wisata-card h-100">
                                @if($d->image)
                                    <img src="{{ asset('storage/'.$d->image) }}"
                                         alt="{{ $d->name }}"
                                         class="wisata-card-img">
                                @else
                                    <div class="wisata-card-placeholder">
                                        Foto wisata belum tersedia
                                    </div>
                                @endif

                                <div class="wisata-card-body">
                                    <div class="wisata-meta">
                                        @if($d->created_at)
                                            {{ $d->created_at->translatedFormat('d M Y') }}
                                        @else
                                            Destinasi Balikpapan
                                        @endif
                                    </div>

                                    <div class="wisata-name">
                                        {{ $d->name }}
                                    </div>

                                    <p class="wisata-desc mb-0">
                                        {{ \Illuminate\Support\Str::limit($d->description, 110) }}
                                    </p>

                                    @if($d->location)
                                        <a href="{{ $d->location }}" target="_blank" class="wisata-link">
                                            Lihat di Google Maps
                                            <span class="wisata-link-icon">↗</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if(method_exists($destinations, 'links'))
                    <div class="mt-4 d-flex justify-content-center wisata-pagination">
                        {{ $destinations->links() }}
                    </div>
                @endif
            @else
                <p class="mt-4 text-muted">
                    Belum ada destinasi wisata yang ditambahkan.
                </p>
            @endif
        </div>
    </div>
</div>
@endsection
