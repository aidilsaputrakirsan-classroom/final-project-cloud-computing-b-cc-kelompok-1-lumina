@extends('layouts.app')

@section('content')
<style>
    .history-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px 36px;
        justify-items: center;
        margin-top: 34px;
    }
    .history-card {
        width: 100%;
        max-width: 320px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(10,35,50,.1);
        padding: 0 0 18px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform .19s, box-shadow .22s;
        border: none;
        position: relative;
    }
    .history-card:hover {
        transform: translateY(-6px) scale(1.019);
        box-shadow: 0 16px 32px rgba(10,35,50,.16);
    }
    .history-card-imgbox {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 170px;
        background: #fafafa;
        border-radius: 16px 16px 0 0;
        overflow: hidden;
    }
    .history-card-imgbox img {
        max-width: 90%;
        max-height: 120px;
        object-fit: contain;
        display: block;
        margin: auto;
        filter: drop-shadow(0 2px 6px rgba(8,24,40,.06));
    }
    .history-title {
        font-size: 1.21rem;
        font-weight: 700;
        margin: 22px 0 8px 0;
        color: #243042;
    }
    .history-date {
        font-size: 0.97rem;
        color: #888;
        margin-bottom: 12px;
    }
    .history-link {
        margin-top: 6px;
        padding: 6px 20px;
        font-size: .96rem;
        font-weight: 600;
        border-radius: 99px;
        color: #176C8C;
        border: 1.5px solid #bddae6;
        background: #f6fbfd;
        transition: .15s;
        text-decoration: none;
    }
    .history-link:hover {
        background: #ddeeff;
        color: #19729F;
        border-color: #64b8dd;
        text-decoration: underline;
    }
    @media (max-width: 991px) {
        .history-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .history-grid { grid-template-columns: 1fr; }
    }
</style>

<h1 class="fw-bold display-4 mb-2 text-center" style="color:#1E2A36;">
    Info <span class="text-warning">Balikpapan</span>
</h1>
    <p class="sejarah-subtitle mb-4 text-center">
      Semua hal tentang Kota Balikpapan, mulai dari tempat wisata, sejarah, budaya, makanan khas, hingga informasi kegiatan dan kehidupan masyarakat di kota ini.
    </p>

<div class="history-grid">
    @forelse($histories as $history)
        <div class="history-card">
            <div class="history-card-imgbox">
                @if($history->image)
                    <img src="{{ asset('storage/'.$history->image) }}" alt="{{ $history->title }}">
                @else
                    <div style="color:#bbb;font-size:1rem;font-weight:500">Gambar Sejarah</div>
                @endif
            </div>
            <div class="history-title">{{ $history->title }}</div>
            <div class="history-date">
                {{ $history->event_date ? $history->event_date->format('d F Y') : '-' }}
            </div>
            <a href="{{ route('sejarah.show', ['history' => $history->slug]) }}" class="history-link">Baca selengkapnya</a>
        </div>
    @empty
        <div style="text-align:center;font-size:1.25rem;color:#aaa;">Belum ada data sejarah.</div>
    @endforelse
</div>
@endsection
