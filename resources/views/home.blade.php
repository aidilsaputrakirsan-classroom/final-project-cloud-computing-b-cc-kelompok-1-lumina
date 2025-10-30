<!DOCTYPE html>
<html>
<head>
    <title>Sejarah Balikpapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #faf7f2; }
        .navbar-custom { background: #123c51; }
        .navbar-brand { font-weight: bold; font-size: 1.6rem; color: #ffe082 !important; letter-spacing: 1px; }
        .nav-link, .dropdown-item { color: #fff !important; }
        .nav-link:hover, .dropdown-item:hover { color: #ffe082 !important; }
        .navbar .form-control { border-radius: 20px; }
        .main-header { background: #0d3044; color: #fff; padding: 2rem 0; }
        .footer { background: #123c51; color: #fff; padding: 1rem 0; margin-top: 4rem; }
        .news-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; overflow: hidden;}
        .news-img { object-fit: cover; height: 200px; width: 100%; }
        .carousel-caption {
            background: rgba(20,35,50,0.7); border-radius: 16px; padding: 20px 30px;
        }
        .carousel-item img {
            object-fit: cover;
            height: 350px;
            width: 100%;
            filter: brightness(0.75);
        }
    </style>
</head>
<body>
    <!-- HEADER NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('img/logo jelajah balikpapan.png') }}" alt="Logo" width="32" height="32" class="me-2">
  Jelajah Balikpapan

        </a>
        <form class="d-flex mx-auto" role="search" style="max-width: 350px;">
          <input class="form-control me-2" type="search" placeholder="Cari sejarah..." aria-label="Search">
          <button class="btn btn-warning" type="submit">Cari</button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                Categories
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Tokoh</a></li>
                <li><a class="dropdown-item" href="#">Peristiwa</a></li>
                <li><a class="dropdown-item" href="#">Tempat Bersejarah</a></li>
                <li><a class="dropdown-item" href="#">Budaya</a></li>
                <li><a class="dropdown-item" href="#">Ekonomi</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffe082" class="bi bi-person-circle me-1 mb-1" viewBox="0 0 16 16">
                  <path d="M13.468 12.37C12.758 11.226 11.483 10.5 10 10.5c-1.483 0-2.758.726-3.468 1.87A6.97 6.97 0 0 0 8 15a6.97 6.97 0 0 0 5.468-2.63ZM8 9.5A3 3 0 1 0 8 3.5a3 3 0 0 0 0 6ZM8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1Zm0 13a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"/>
                </svg>
                Akun
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- SLIDER CAROUSEL ATAS -->
    <div id="mainCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('img/Kota-Balikpapan.jpg') }}" class="d-block w-100" alt="Sejarah 1">
          <div class="carousel-caption text-start">
            <h2>Balikpapan, Kota Minyak</h2>
            <p>Awal pertumbuhan sebagai pusat industri minyak di Kalimantan Timur. Sejarah panjang membawa dampak besar untuk perekonomian dan budaya lokal.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('img/RDMP-Balikpapan2_1.jpg') }}" class="d-block w-100" alt="Sejarah 2">
          <div class="carousel-caption text-start">
            <h2>Pusat Energi Nasional</h2>
            <p>Sebagai penggerak utama migas, kota ini menjadi penopang kebutuhan nasional serta memiliki sejarah militer penting pada masa perang dunia.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('img/34183-airy-rooms.jpg') }}" class="d-block w-100" alt="Sejarah 3">
          <div class="carousel-caption text-start">
            <h2>Ragam Budaya & Harmoni</h2>
            <p>Kota dengan banyak pendatang yang hidup berdampingan harmonis hingga kini. Balikpapan, cermin pluralisme Indonesia Timur.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#mainCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </a>
      <a class="carousel-control-next" href="#mainCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </a>
    </div>

    <!-- HEADER TEMA -->
    <div class="main-header text-center">
        <h1>Balikpapan</h1>
        <p>Bersih, Indah, Aman dan Nyaman</p>
    </div>

    <!-- SECTION INFO SEJARAH BALIKPAPAN -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <h3 class="text-center fw-bold">Sejarah Balikpapan</h3>
      <p class="text-center text-secondary mb-5" style="max-width:700px;margin:auto;">
        Sejarah Balikpapan bermula sebagai desa nelayan yang terpencil, namun nasibnya berubah drastis dengan ditemukannya minyak. Titik penting dalam sejarahnya adalah 10 Februari 1897, tanggal pengeboran Sumur Mathilda yang pertama kali, yang kini diperingati sebagai hari jadi kota dan mengukuhkan statusnya sebagai "Kota Minyak". Mengenai asal-usul namanya, versi terpopuler adalah legenda sepuluh keping papan ("Balik Papan") milik Sultan Kutai yang hanyut dan ditemukan kembali di pantai, meski ada juga teori yang mengaitkannya dengan Suku Pasir Balik. Karena kekayaan sumber dayanya, Balikpapan menjadi lokasi pertempuran strategis yang sengit antara pasukan Jepang dan Sekutu selama Perang Dunia II, sebelum akhirnya berkembang menjadi pusat industri migas modern yang vital bagi Indonesia.
      </p>
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="mx-auto mb-3" style="background:#f3f3f3; width:80px; height:80px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('img/logo_balikpapan_nyaman.webp') }}" alt="Visi Icon" style="width:40px; height:40px; object-fit:contain;">
              <path d="M8.051 1.999A6.002 6.002 0 0 1 13.995 8H8v6.995A6.002 6.002 0 0 1 2.005 8.001a6.002 6.002 0 0 1 6.046-6.002zm1.5 6.001A1.5 1.5 0 1 1 8.05 6.001a1.5 1.5 0 0 1 1.501 1.999zm3.448 3.39a7 7 0 1 0-2.883 2.883 8 8 0 0 0 2.883-2.883z"/>
            </svg>
          </div>
          <h5>Visi dan Misi Kota Balikpapan</h5>
          <p class="text-secondary small">
            Terwujudnya Balikpapan Sebagai Kota Terkemuka yang Nyaman Dihuni, Modern, dan Sejahtera Dalam Bingkai Madinatul Iman
          </p>
        </div>
        <div class="col-md-4 mb-4">
          <div class="mx-auto mb-3" style="background:#f3f3f3; width:80px; height:80px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('img/Logo bpn.png') }}" alt="Visi Icon" style="width:40px; height:40px; object-fit:contain;">
              <path d="M7.5 1v2H2v13h12V3h-5.5V1h-1zm1 13h5v-9H2v9h5v-6h1v6zm0-7V4h5v3h-5zm-1 0H2V4h5v3z"/>
            </svg>
          </div>
          <h5>Moto Kota Balikpapan</h5>
          <p class="text-secondary small">
            Motto kota Balikpapan adalah <span class="fw-bold">"Balikpapan Kota Beriman"</span>, yang merupakan singkatan dari <span class="fw-bold">Bersih, Indah, Aman, dan Nyaman</span>.
          </p>
        </div>
        <div class="col-md-4 mb-4">
          <div class="mx-auto mb-3" style="background:#f3f3f3; width:80px; height:80px; border-radius:50%; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('img/balikpapanMascot.png') }}" alt="Visi Icon" style="width:40px; height:40px; object-fit:contain;">
              <path d="M8 9.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4.5 3A4.5 4.5 0 0 0 8 8a4.5 4.5 0 0 0-4.5 4.5v.5A2.5 2.5 0 0 0 6 15h4a2.5 2.5 0 0 0 2.5-2.5v-.5z"/>
            </svg>
          </div>
          <h5>Kenapa Dinamakan Balikpapan?</h5>
          <p class="text-secondary small">
            Nama "Balikpapan" berasal dari kisah rakyat setempat tentang Putri Petung yang berjuang menyelamatkan dirinya dengan ditelungkupkan di atas papan dan hanyut ke laut, sehingga disebut "papan yang terbalik".
          </p>
        </div>
      </div>
      <div class="card border-0 shadow-sm mt-4" style="background: #f7f7f7;">
        <div class="card-body">
          <div class="fw-bold pb-2" style="font-size:1.15rem;">Tau gak sih, kenapa kota ini dinamakan kota Balikpapan?</div>
          <div style="font-size: 0.98rem; color: #666;">
            Kisah Putri Petung, anak dari Raja Pasir untuk melindungi sang putri dari serangan musuh, raja terpaksa membuangnya ke laut saat masih bayi. Putri Petung diletak di atas selembar papan dan dilepaskan mengikuti arus laut. Namun, karena ombak yang kuat, papan itu terbalik, meninggalkan Putri Petung terikat di baliknya. Beberapa waktu kemudian, seorang nelayan menemukan anak putri dalam keadaan masih hidup dan terikat di balik papan tersebut. Sejak peristiwa itu, tempat pendaratannya dinamakan Balikpapan, yang berarti "papan yang terbalik".
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END SECTION INFO SEJARAH -->

    <!-- CONTENT BERITA / BLOG -->
    <div class="container my-5">
        <h2 class="mb-4">Berita & Konten Terbaru</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?fit=crop&w=600&q=80" class="news-img" alt="Berita 1">
                    <div class="p-4">
                        <h5>Balikpapan Dulu & Kini</h5>
                        <p>Kilas balik perkembangan Balikpapan dari kampung pesisir menjadi metropolitan energi nasional.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1465101178521-c1a9136a3b5a?fit=crop&w=600&q=80" class="news-img" alt="Berita 2">
                    <div class="p-4">
                        <h5>Jejak Jepang di Balikpapan</h5>
                        <p>Bagaimana pendudukan Jepang dan sekutu membentuk karakter sosial serta infrastruktur kota hingga sekarang.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="news-card">
                    <img src="https://images.unsplash.com/photo-1502082553048-f009c37129b9?fit=crop&w=600&q=80" class="news-img" alt="Berita 3">
                    <div class="p-4">
                        <h5>Harmoni Etnis & Budaya</h5>
                        <p>Panas, multietnis, dan toleran. Balikpapan sebagai kota dengan harmoni budaya tinggi sejak masa kolonial.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        &copy; {{ date('Y') }} Sejarah Balikpapan - Laravel Demo
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
