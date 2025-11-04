@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <h1 class="fw-bold display-4 mb-3 text-center" style="color:#1E2A36; letter-spacing:2px;">
        Info <span class="text-warning">Balikpapan</span>
    </h1>
    <div class="mb-4"></div> <!-- Spacer untuk memberi jarak antara judul dan artikel -->

    <div class="row row-cols-1 row-cols-md-3 g-5 justify-content-center py-2">
        @for($i = 0; $i < 9; $i++)
        <div class="col d-flex flex-column align-items-center">
            <div class="bg-light border rounded-2 d-flex justify-content-center align-items-center mb-3" style="width:220px; height:220px;">
                {{-- Ganti src asset sesuai gambar artikel --}}
                <img src=".jpg" class="img-fluid" alt="Gambar Sejarah" style="object-fit:cover; max-width:95%; max-height:95%;">
            </div>
            <h5 class="fw-semibold text-center mb-1" style="font-size:1.13rem;">
                @if($i%3==0)
                  Jejak Panjang dari Kampung Nelayan ke Kota Minyak
                @elseif($i%3==1)
                  Pengeboran Minyak Pertama dan Masuknya Kolonial Belanda
                @else
                  Pasca-Kemerdekaan: Pemulihan dan Nasionalisasi Minyak
                @endif
            </h5>
            <div class="text-center text-muted mb-2" style="font-size:.95rem;">20 Oktober 2025</div>
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-1" style="min-width:95px;">Read more</a>
        </div>
        @endfor
    </div>
</div>
@endsection
