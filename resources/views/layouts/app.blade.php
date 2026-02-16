<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard BSK')</title>
    {{-- CSS UTAMA --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Logo Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS app.blade.php -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    {{-- NAVBAR --}}
    <div class="navbar navbar-main">
        <div class="navbar-container">
            <div class="navbar-left">
                <img src="{{ asset('assets/logobsk.png') }}" class="logo-bsk">
                <h2 class="navbar-title">BSK Masjid Mukhlishin</h2>
            </div>

            <div class="nav-menu">
                <a href="{{ route('keluarga.index') }}">Keluarga</a>
                <a href="{{ route('iuran.index') }}">Kutipan</a>
                <a href="{{ route('saldo.index') }}">Saldo</a>
                <a href="{{ route('inventaris.index') }}">Inventaris</a>
                <a href="{{ route('pengumuman.index') }}">Pengumuman</a>

                <div class="dropdown">
                    <a href="#" class="dropdown-toggle">Lainnya</a>
                    <div class="dropdown-menu">
                        <a href="">Laporan</a>
                        <a href="">Data Kematian</a>
                        <a href="">Santunan</a>
                        <a href="">Pengaturan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- CONTENT --}}
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6'
    });
});
</script>
@endif

</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.querySelector('.dropdown');
        const toggle = document.querySelector('.dropdown-toggle');

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            dropdown.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    });
</script>

