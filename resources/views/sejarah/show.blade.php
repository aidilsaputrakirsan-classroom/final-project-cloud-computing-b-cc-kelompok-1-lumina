@extends('layouts.app')

@section('content')
<style>
    .history-detail-section {
        max-width: 950px;
        margin: 0 auto;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 6px 24px rgba(18,60,81,0.05); /* lebih soft, bisa dihilangkan jika perlu */
        padding: 48px 34px 38px;
    }
    .history-img-box {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 18px;
        overflow: hidden;
        background: #fafafa;
        margin-bottom: 32px;
        box-shadow: none !important; /* Tidak ada shadow di belakang gambar */
    }
    .history-img-box img {
        max-width: 410px;
        max-height: 280px;
        border-radius: 13px;
        box-shadow: none !important; /* Tidak ada shadow */
    }
    .history-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: #1e2a36;
        margin-bottom: 12px;
        letter-spacing: 0.01em;
        text-align: center;
    }
    .history-meta {
        color: #888;
        font-size: 1.05rem;
        margin-bottom: 30px;
        text-align: center;
    }
    .history-meta span {
        margin: 0 10px;
        font-weight: 600;
        color: #636e72;
    }
    .history-content {
        font-size: 1.11rem;
        color: #273447;
        line-height: 1.77;
        text-align: justify;
        margin-top: 8px;
    }
    .back-link {
        display: inline-block;
        margin-bottom: 38px;
        font-size: 1.08rem;
        font-weight: 700;
        background: #d7e7fd;
        color: #2362A1 !important;
        border-radius: 99px;
        padding: 11px 33px 11px 26px;
        text-decoration: none !important;
        box-shadow: 0 1px 8px rgba(35,100,190,0.06);
        border: none;
        transition: background .15s, color .15s;
    }
    .back-link:hover {
        background: #9acdf4;
        color: #1b3c7d !important;
        text-decoration: underline !important;
    }
    @media (max-width: 720px) {
        .history-detail-section {
            max-width: 99vw;
            padding: 20px 0.6rem 22px;
        }
        .history-title { font-size: 1.08rem; }
        .history-img-box img { max-width: 97vw;}
    }
</style>

<div class="container py-4">

    <a href="{{ route('sejarah.index') }}" class="back-link mb-4">
        ← Kembali ke Sejarah
    </a>

    <div class="history-detail-section">
        @if($history->image)
        <div class="history-img-box">
            <img src="{{ asset('storage/'.$history->image) }}" alt="{{ $history->title }}">
        </div>
        @endif

        <div class="history-title">{{ $history->title }}</div>

        <div class="history-meta">
            {{ $history->event_date ? $history->event_date->format('d F Y') : '-' }}
            @if($history->category)
            <span>|</span>Kategori: {{ $history->category->name }}
            @endif
        </div>

        <div class="history-content">{!! nl2br(e($history->content)) !!}</div>
    </div>
</div>
@endsection
