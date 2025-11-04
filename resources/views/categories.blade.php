@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="container py-5">

    {{-- Section Tokoh --}}
    <section id="tokoh" class="mb-5">
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <h2 class="fw-bold mb-3 text-primary">Tokoh</h2>
            <p class="mb-2 text-secondary">
                Balikpapan telah melahirkan banyak tokoh berpengaruh dalam sejarah, pemerintahan, seni, dan perjuangan kemerdekaan. Salah satu pahlawan penting adalah Letkol Pol. H.M. Asnawi Arbain serta bangsawan Sultan Aji Muhammad Sulaiman, termasuk pula tokoh modern seperti Walikota Abdul Gafur Mas’ud dan entrepreneur H. M. Jos Soetomo.<br>
                Kota ini juga dikenal sebagai tempat tumbuhnya pemimpin dan peneliti, serta berbagai tokoh yang menerima penghargaan Anugerah Khusus Pemkot Balikpapan atas dedikasinya membangun kota dan bangsa.
            </p>
        </div>
    </section>

    {{-- Section Peristiwa --}}
    <section id="peristiwa" class="mb-5">
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <h2 class="fw-bold mb-3 text-success">Peristiwa</h2>
            <p class="mb-2 text-secondary">
                Beragam peristiwa besar membentuk Balikpapan, mulai dari pengeboran sumur Mathilda pada 1897 yang menandai era migas, hingga pertempuran sengit di Perang Dunia II ketika kota ini menjadi rebutan Jepang dan Sekutu.<br>
                Proklamasi kemerdekaan dan perlawanan rakyat pun menjadi bagian penting sejarahnya, termasuk insiden demonstrasi 13 November 1945 yang kini diabadikan dalam tugu peringatan, menjadi simbol semangat kemerdekaan warga Balikpapan.
            </p>
        </div>
    </section>

    {{-- Section Tempat Bersejarah --}}
    <section id="tempat-bersejarah" class="mb-5">
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <h2 class="fw-bold mb-3 text-warning">Tempat Bersejarah</h2>
            <ul class="mb-2 ps-3 text-secondary" style="line-height: 1.7;">
                <li><strong>Monumen Perjuangan Rakyat (Monpera):</strong> Tugu peringatan simbol perjuangan rakyat, sekaligus ikon kota dan pelestari sejarah kemerdekaan.</li>
                <li><strong>Rumah Dahor Heritage:</strong> Cagar budaya tempat informasi sejarah eksplorasi minyak, kini jadi taman baca dan perpustakaan.</li>
                <li><strong>Kilang Minyak Pertamina:</strong> Salah satu kilang tertua dan pusat pertumbuhan ekonomi Balikpapan sejak era Belanda hingga kini.</li>
            </ul>
            <p class="text-secondary mb-0">
                Selain itu, Tugu Proklamasi, lokasi peninggalan Jepang, dan berbagai rumah tua juga menjadi saksi bisu perjalanan Balikpapan dari masa ke masa.
            </p>
        </div>
    </section>

    {{-- Section Budaya --}}
    <section id="budaya" class="mb-5">
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <h2 class="fw-bold mb-3 text-danger">Budaya</h2>
            <p class="mb-2 text-secondary">
                Balikpapan adalah kota multietnik dengan budaya harmonis; penduduknya terdiri dari Suku Balik, Dayak, Banjar, Bugis, Jawa, dan lainnya.<br>
                Tradisi seperti <b>Upacara Erau</b>, seni tari dan musik tradisional, batik motif lokal, serta kuliner seperti Bubur Gunting dan Roti Mantau jadi daya tarik istimewa, memperkaya khasanah keragaman budaya kota.<br>
                Kerajinan manik-manik dan seni Mandau (senjata tradisional) juga banyak dijumpai sebagai bagian dari identitas masyarakat.
            </p>
        </div>
    </section>

    {{-- Section Ekonomi --}}
    <section id="ekonomi" class="mb-5">
        <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
            <h2 class="fw-bold mb-3 text-info">Ekonomi</h2>
            <p class="mb-2 text-secondary">
                Balikpapan adalah pusat ekonomi terbesar di Kalimantan, dikenal sebagai “Kota Minyak”. Industri migas, pertambangan, dan pengolahan menjadi pilar ekonomi utama, bahkan menyumbang hampir setengah produk domestik regional Bruto kota.<br>
                Selain itu, perdagangan, jasa, investasi, serta pengembangan pelabuhan dan bandara internasional terus memperkuat peran Balikpapan sebagai kota bisnis, energi, dan penopang ibukota baru Indonesia.
            </p>
        </div>
    </section>

</div>
@endsection
