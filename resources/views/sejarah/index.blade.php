@extends('layouts.app')

@section('content')
<h1 class="fw-bold display-4 mb-2 text-center" style="color:#1E2A36;">
    Info <span class="text-warning">Balikpapan</span>
</h1>

<div style="display: flex; flex-wrap: wrap; gap:40px; justify-content:center;">
    @forelse($histories as $history)
    <div style="width:300px;background:#fff;border-radius:16px;padding:20px;margin:20px;text-align:center;">
        <div style="width:220px;height:180px;background:#FAFAFA;margin:auto;border-radius:12px;display:flex;align-items:center;justify-content:center;">
            @if($history->image)
                <img src="{{ asset('storage/'.$history->image) }}" alt="{{ $history->title }}" style="max-width:150px;max-height:120px;" />
            @else
                <span>Gambar Sejarah</span>
            @endif
        </div>

        <h4 style="margin-top:18px;">{{ $history->title }}</h4>
        <p style="color:#888;">
            {{ $history->event_date ? $history->event_date->format('d F Y') : '-' }}
        </p>

        <a href="{{ route('sejarah.show', $history->slug) }}" class="btn btn-outline-secondary">Read more</a>
    </div>
    @empty
        <div style="text-align:center;font-size:1.3rem;color:#aaa;margin-top:30px;">
            Belum ada data sejarah.
        </div>
    @endforelse
</div>
@endsection
