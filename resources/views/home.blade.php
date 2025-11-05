@extends('layouts.app')
@section('title', 'Home - Jelajah Balikpapan')

@section('content')
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <h1 class="fw-bold display-4 mb-2" style="color:#1E2A36;">
                Menghidupkan Sejarah, Menggali Pesona <span class="text-warning">Balikpapan</span>
            </h1>
            <p class="lead text-muted mb-4">
                Jelajah Balikpapan adalah pintu masuk bagi siapa pun yang ingin mengenal kota minyak, warisan, serta harmoni warganya.
            </p>
        </div>
        <div class="col-md-6 text-center">
            {{-- Carousel Swipe Balikpapan --}}
            <div id="mainCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4 overflow-hidden shadow">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/Kota-Balikpapan.jpg') }}" class="d-block w-100" alt="Sejarah 1" style="object-fit:cover; height:280px;filter: brightness(0.8);">
                        <div class="carousel-caption text-start p-4" style="background: rgba(18,60,81,0.68); border-radius: 18px; left: 5%; right:auto;">
                            <h2 class="fw-bold text-warning mb-1">Balikpapan, Kota Minyak</h2>
                            <p class="mb-0 small">Awal pertumbuhan sebagai pusat industri minyak di Kalimantan Timur.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/RDMP-Balikpapan2_1.jpg') }}" class="d-block w-100" alt="Sejarah 2" style="object-fit:cover; height:280px;filter: brightness(0.8);">
                        <div class="carousel-caption text-end p-4" style="background: rgba(18,60,81,0.68); border-radius: 18px; right: 5%; left:auto;">
                            <h2 class="fw-bold text-warning mb-1">Pusat Energi Nasional</h2>
                            <p class="mb-0 small">Penggerak utama migas & sejarah militer kota penting di era Perang Dunia.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/34183-airy-rooms.jpg') }}" class="d-block w-100" alt="Sejarah 3" style="object-fit:cover; height:280px;filter: brightness(0.8);">
                        <div class="carousel-caption text-end p-4" style="background: rgba(18,60,81,0.68); border-radius: 18px; right: 5%; left:auto;">
                            <h2 class="fw-bold text-warning mb-1">Ragam Budaya & Harmoni</h2>
                            <p class="mb-0 small">Kota beragam pendatang, hidup rukun, cermin pluralisme Timur.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="container pb-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <img src="{{ asset('img/logo_balikpapan_nyaman.webp') }}" style="width:48px;" class="mb-2">
                <h5 class="fw-bold">Visi dan Misi</h5>
                <p class="text-muted small mb-0">Terwujudnya Balikpapan sebagai kota terkemuka yang nyaman dihuni, modern, dan sejahtera dalam bingkai Madinatul Iman.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <img src="{{ asset('img/Logo bpn.png') }}" style="width:48px;" class="mb-2">
                <h5 class="fw-bold">Moto Kota Balikpapan</h5>
                <p class="text-muted small mb-0">
                    <span class="text-warning">BALIKPAPAN KOTA BERIMAN</span><br>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <img src="{{ asset('img/balikpapanMascot.png') }}" style="width:48px;" class="mb-2">
                <h5 class="fw-bold">Maskot Balikpapan</h5>
                <p class="text-muted small mb-0">Beruang Madu menjadi simbol jiwa pejuang dan penjaga hutan di kota ini, serta menunjukkan komitmen Balikpapan dalam melestarikan ekosistem hutan.</p>
            </div>
        </div>
    </div>
</section>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="rounded-4 bg-light p-4 shadow-sm mb-4">
                <h4 class="fw-bold mb-2 text-center">Sejarah Balikpapan</h4>
                <p class="mb-0 text-secondary text-center" style="font-size:1.08rem;">
                    Balikpapan, yang dikenal sebagai "Kota Minyak", memiliki sejarah yang kaya dengan penemuan sumur minyak pertama pada 10 Februari 1897. Penamaan sumur ini berasal dari nama anak JH Menten dan Firma Samuel & Co. yang menang hak konsesi pengeboran. Keberadaan minyak di Balikpapan telah membawa banyak pendatang, terutama orang Cina dan pekerja pengeboran dari Jawa dan India, yang menjadi asal usul sebagian besar warga Balikpapan. Seiring waktu, Balikpapan berkembang menjadi kota industri yang mengolah minyak mentah dari sekitarnya dan juga minyak impor dari negara lain.
                </p>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mt-4 bg-light">
        <div class="card-body">
            <div class="fw-bold pb-2" style="font-size:1.10rem;">Tau gak sih, kenapa kota ini dinamakan kota Balikpapan?</div>
            <div style="font-size: 0.98rem; color: #666;">
                Dari kisah Putri Petung, anak dari Raja Pasir untuk melindungi sang putri dari serangan musuh, raja terpaksa membuangnya ke laut saat masih bayi. Putri Petung diletak di atas selembar papan dan dilepaskan mengikuti arus laut. Namun, karena ombak yang kuat, papan itu terbalik, meninggalkan Putri Petung terikat di baliknya. Beberapa waktu kemudian, seorang nelayan menemukan anak putri dalam keadaan masih hidup dan terikat di balik papan tersebut. Sejak peristiwa itu, tempat pendaratannya dinamakan Balikpapan, yang berarti "papan yang terbalik".
            </div>
        </div>
    </div>
</section>

<section class="container pb-5">
    <h3 class="fw-bold text-center mb-4">Berita & Konten Terbaru</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                <img src="https://jejakpiknik.com/wp-content/uploads/2018/06/Pemandangan-Sekitar-Pantai-Batu.jpg" class="card-img-top" alt="Berita 1" style="object-fit:cover; height:185px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Balikpapan Dulu & Kini</h6>
                    <p class="text-muted small mb-3">Kilas balik perkembangan Balikpapan dari kampung pesisir menjadi metropolitan energi nasional.</p>
                    <a href="#" class="btn btn-sm btn-outline-warning px-3 rounded-pill">Baca selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                <img src="https://pontianakinfo.disway.id/upload/aea20f32051580a979f413f40529a487.jpg" class="card-img-top" alt="Berita 2" style="object-fit:cover; height:185px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Jejak Jepang di Balikpapan</h6>
                    <p class="text-muted small mb-3">Bagaimana pendudukan Jepang dan sekutu membentuk karakter sosial serta infrastruktur kota hingga sekarang.</p>
                    <a href="#" class="btn btn-sm btn-outline-warning px-3 rounded-pill">Baca selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                <img src="https://jurnalborneo.com/wp-content/uploads/2024/02/bref-.jpg" class="card-img-top" alt="Berita 3" style="object-fit:cover; height:185px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Harmoni Etnis & Budaya</h6>
                    <p class="text-muted small mb-3">Panas, multietnis, dan toleran. Balikpapan sebagai kota dengan harmoni budaya tinggi sejak masa kolonial.</p>
                    <a href="#" class="btn btn-sm btn-outline-warning px-3 rounded-pill">Baca selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
