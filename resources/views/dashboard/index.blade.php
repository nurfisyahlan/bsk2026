@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- ===== CAROUSEL ===== --}}
<div id="dashboardCarousel" class="carousel slide mb-5" data-bs-ride="carousel">

    {{-- Indicator --}}
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#dashboardCarousel" data-bs-slide-to="2"></button>
    </div>

    {{-- Isi Carousel --}}
    <div class="carousel-inner rounded shadow">

        <div class="carousel-item active">
            <img src="{{ asset('assets/mukhlishin.png') }}" class="d-block w-100" style="height:350px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Badan Sosial Kematian</h5>
                <p>Manajemen data sosial masjid secara digital</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('assets/logo2.png') }}" class="d-block w-100" style="height:350px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Transparansi Kas</h5>
                <p>Pencatatan saldo dan iuran lebih rapi & aman</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/carousel/bsk3.jpg') }}" class="d-block w-100" style="height:350px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5>Pelayanan Cepat</h5>
                <p>Inventaris & pengumuman terkelola dengan baik</p>
            </div>
        </div>

    </div>

    {{-- Tombol Navigasi --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

{{-- ===== JUDUL ===== --}}
<h1 style="text-align:center; margin-bottom:40px;">
    Dashboard Badan Sosial Kematian
</h1>

{{-- ===== INFO BAR STATISTIK ===== --}}
<div class="stats-bar mb-3">
    <div class="stat-item">
        <span class="stat-label">Total Keluarga</span>
        <span class="stat-value">{{ $totalKeluarga }}</span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Total Jiwa</span>
        <span class="stat-value">{{ $totalJiwa }}</span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Saldo Kas</span>
        <span class="stat-value">
            Rp {{ number_format($totalSaldo, 0, ',', '.') }}
        </span>
    </div>

    <div class="stat-item">
        <span class="stat-label">Inventaris</span>
        <span class="stat-value">{{ $totalInventaris }}</span>
    </div>
</div>


{{-- ===== MENU CARD ===== --}}
<div class="menu-grid">

    <a href="{{ route('keluarga.index') }}" class="menu-card">
        <span class="menu-icon">👨‍👩‍👧‍👦</span>
        Data Keluarga
    </a>

    <a href="{{ route('saldo.index') }}" class="menu-card">
        <span class="menu-icon">💰</span>
        Saldo Kas
    </a>

    <a href="{{ route('iuran.index') }}" class="menu-card">
        <span class="menu-icon">📝</span>
        Data Kutipan
    </a>

    <a href="{{ route('inventaris.index') }}" class="menu-card">
        <span class="menu-icon">📦</span>
        Inventaris
    </a>

    <a href="#" class="menu-card">
        <span class="menu-icon">📢</span>
        Pengumuman
    </a>

</div>


{{-- ===== TENTANG BSK ===== --}}
    <div class="container about-section mt-5 mb-5">

        <h2 class="text-center mb-4">Tentang Badan Sosial Kematian</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="about-card shadow-sm">
                    <p>
                        <strong>Badan Sosial Kematian (BSK)</strong> Masjid Mukhlishin adalah lembaga sosial
                        yang bertugas mengelola iuran, kas, inventaris, serta pelayanan sosial
                        bagi warga anggota BSK, khususnya dalam urusan kematian dan takziah.
                    </p>

                    <p>
                        Sistem ini dibuat untuk membantu pengurus dalam melakukan
                        pencatatan data secara <strong>digital, transparan, dan tertib</strong>,
                        sehingga pelayanan kepada masyarakat dapat berjalan lebih cepat dan akurat.
                    </p>

                    <div class="about-highlight">
                        <div>📌 Transparansi Data</div>
                        <div>📌 Pelayanan Cepat</div>
                        <div>📌 Administrasi Rapi</div>
                        <div>📌 Berbasis Masjid</div>
                    </div>

                </div>

            </div>
        </div>

    </div>


{{-- ===== FOOTER ===== --}}
<footer class="mt-5 pt-4 pb-3 bg-light border-top">
    <div class="container">
        <div class="row">

            {{-- Alamat --}}
            <div class="col-md-6 mb-3">
                <h5>Badan Sosial Kematian</h5>
                <p class="mb-1">
                    Masjid Mukhlishin<br>
                    Jl. Cempaka No. 104, Kel. Padang Bulan, Kec. Senapelan<br>
                    Kota Pekanbaru, Riau 28156
                </p>
            </div>

            {{-- Sosial Media --}}
            <div class="col-md-6 mb-3 text-md-end">
                <h5>Sosial Media</h5>
                <a href="#" class="text-decoration-none me-3">
                    🌐 Website
                </a>
                <a href="#" class="text-decoration-none me-3">
                    📘 Facebook
                </a>
                <a href="#" class="text-decoration-none me-3">
                    📷 Instagram
                </a>
                <a href="#" class="text-decoration-none">
                    📱 WhatsApp
                </a>
            </div>

        </div>

        <hr>

        <div class="text-center small text-muted">
            © {{ date('Y') }} Badan Sosial Kematian Masjid Mukhlishin. All rights reserved.
        </div>
    </div>
</footer>


@endsection
