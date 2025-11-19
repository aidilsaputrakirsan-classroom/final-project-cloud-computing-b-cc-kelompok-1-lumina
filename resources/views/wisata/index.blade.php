@extends('layouts.app')

@section('title', 'Wisata Balikpapan')

@section('content')
<style>
    .wisata-page { padding: 24px 0 40px; }
    .wisata-section { background: #ffffff; border-radius: 18px; padding: 28px 28px 36px; box-shadow: 0 16px 32px rgba(12, 33, 45, 0.12); }
    .wisata-subtitle { color: #6a7a80; font-size: 0.95rem; }
    .wisata-grid { margin-top: 24px; }
    .wisata-card { border-radius: 16px; border: 1px solid #e2e7ea; overflow: hidden; background: #f8fbfd; box-shadow: 0 6px 16px rgba(10, 35, 50, 0.08); transition: transform .25s, box-shadow .25s, background .25s, border-color .25s; height: 100%; cursor: pointer; }
    .wisata-card:hover { transform: translateY(-6px); box-shadow: 0 18px 30px rgba(10, 35, 50, 0.18); background: #fff; border-color: #c1d2dd; }
    .wisata-card-img { width: 100%; height: 190px; object-fit: cover; }
    .wisata-card-body { padding: 16px 18px 18px; }
    .wisata-meta { font-size: 0.78rem; color: #9aa6ac; margin-bottom: 4px; }
    .wisata-name { font-weight: 700; font-size: 1.02rem; margin-bottom: 6px; color: #233540; }
    .wisata-desc { font-size: 0.9rem; color: #5f6c71; max-height: 60px; overflow: hidden; transition: max-height .25s; }
    .wisata-card.expanded .wisata-desc { max-height: 1000px; }
    .wisata-link { margin-top: 12px; font-size: 0.86rem; font-weight: 600; color: #0f6e9b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
    .wisata-link:hover { color: #0a4a6a; text-decoration: underline; }
    .wisata-link-icon { font-size: 1rem; line-height: 1; }
    .wisata-card-placeholder { background: #e3edf5; height: 190px; display: flex; align-items: center; justify-content: center; color: #4f6472; font-size: .9rem; font-weight: 600; }
    .wisata-pagination .pagination { margin-bottom: 0; }
    .wisata-pagination .page-link { border-radius: 999px !important; padding: 6px 11px; font-size: 0.85rem; color: #35525b; }
    .wisata-pagination .page-item.active .page-link { background: #0f6e9b; border-color: #0f6e9b; color: #fff; }
    @media (max-width: 768px) { .wisata-section { padding: 22px 16px 28px; } }
</style>

<div class="wisata-page">
  <div class="container">
    <h1 class="fw-bold display-4 mb-2 text-center" style="color:#1E2A36;">
      Wisata <span class="text-warning">Balikpapan</span>
    </h1>
    <p class="wisata-subtitle mb-4 text-center">
      Jelajahi berbagai destinasi wisata menarik di Kota Balikpapan, mulai dari pantai, ruang terbuka hijau, hingga objek wisata keluarga dan edukasi.
    </p>

    <div class="wisata-section">
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
                      Wisata Balikpapan
                    @endif
                  </div>
                  <div class="wisata-name">
                    {{ $d->name }}
                  </div>
                  <p class="wisata-desc mb-0">
                    {{ $d->description }}
                  </p>

                  @if($d->location)
                    <a href="{{ $d->location }}"
                       target="_blank"
                       class="wisata-link"
                       onclick="event.stopPropagation()">
                      Lihat di Google Maps
                      <span class="wisata-link-icon">↗</span>
                    </a>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>

        @if(method_exists($destinations, 'links'))
          <div class="mt-4 d-flex justify-content-center wisata-pagination">
            {{ $destinations->links() }}
          </div>
        @endif
      @else
        <p class="mt-4 text-muted">
          Belum ada wisata yang ditambahkan.
        </p>
      @endif
    </div>
    <!-- KOTAK PUTIH END -->
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.wisata-card').forEach(function (card) {
    card.addEventListener('click', function () {
      card.classList.toggle('expanded');
    });
  });
});
</script>
@endsection
