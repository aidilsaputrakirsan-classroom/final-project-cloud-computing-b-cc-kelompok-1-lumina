@extends('layouts.app')

@section('title', 'Wisata Balikpapan')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Wisata Balikpapan</h1>
    <p class="mb-4">
        Jelajahi berbagai destinasi wisata menarik di Kota Balikpapan, mulai dari pantai,
        ruang terbuka hijau, hingga objek wisata keluarga dan edukasi.
    </p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($destinations->count())
        <div class="row g-3">
            @foreach($destinations as $d)
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $d->name }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($d->description, 140) }}
                            </p>

                            @if($d->location)
                                <a href="{{ $d->location }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Lihat di Google Maps
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $destinations->links() }}
        </div>
    @else
        <p class="text-muted">
            Belum ada destinasi wisata yang ditambahkan.
        </p>
    @endif
</div>
@endsection
