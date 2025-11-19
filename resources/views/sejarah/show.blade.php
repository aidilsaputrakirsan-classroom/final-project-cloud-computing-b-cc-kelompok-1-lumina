@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('sejarah.index') }}" class="btn btn-secondary btn-sm">← Kembali ke Daftar</a>
    </div>

    <div class="card p-4">
        @if($history->image)
            <div class="mb-3">
                <img src="{{ asset('storage/'.$history->image) }}" alt="{{ $history->title }}" class="img-fluid" style="max-width:320px; max-height:240px;">
            </div>
        @endif

        <h2 class="mt-3">{{ $history->title }}</h2>

        <div class="text-muted mb-3">
            {{ $history->event_date ? $history->event_date->format('d F Y') : '-' }}
            @if($history->category)
                | Kategori: {{ $history->category->name }}
            @endif
        </div>

        <div>{!! nl2br(e($history->content)) !!}</div>
    </div>
</div>
@endsection
