<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
    @yield('styles')
</head>
<!-- ... -->
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'SIMPAD Kabupaten Bogor') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Keuangan Daerah">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            padding-top: 70px; 
            padding-bottom: 40px; 
        }
        .navbar-custom {
            background-color: #00A8A8;
        }
        .navbar-custom .nav-link {
            color: #E6E6E6;
        }
    </style>
</head>
<body>
    
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo-header.png') }}" alt="logo-header" style="height:68px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if (Auth::user())
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/b-tax') }}">B-TAX</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pendaftaranDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pendaftaran
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="pendaftaranDropdown">
                                <li><a class="dropdown-item" href="{{ url('/pendaftaran/subjek-pajak') }}">Subjek Pajak</a></li>
                                <li><a class="dropdown-item" href="{{ url('/pendaftaran/objek-pajak') }}">Objek Pajak</a></li>
                                <li><a class="dropdown-item" href="{{ url('/pendaftaran/ektentifikasi') }}">Ektentifikasi</a></li>
                                <li><a class="dropdown-item" href="{{ url('/pendaftaran/laporan') }}">Laporan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pendataanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pendataan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="pendataanDropdown">
                                <li><a class="dropdown-item" href="{{ url('/pendataan/option1') }}">Option 1</a></li>
                                <li><a class="dropdown-item" href="{{ url('/pendataan/option2') }}">Option 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="penerimaanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Penerimaan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="penerimaanDropdown">
                                <li><a class="dropdown-item" href="{{ url('/penerimaan/option1') }}">Option 1</a></li>
                                <li><a class="dropdown-item" href="{{ url('/penerimaan/option2') }}">Option 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="penagihanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Penagihan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="penagihanDropdown">
                                <li><a class="dropdown-item" href="{{ url('/penagihan/option1') }}">Option 1</a></li>
                                <li><a class="dropdown-item" href="{{ url('/penagihan/option2') }}">Option 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/pelayanan') }}">Pelayanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/referensi') }}">Referensi</a>
                        </li>
                    </ul>
                </div>
                @endif
        </nav>

    <div class="content mt-5">
        @yield('content')
    </div>

    <footer class="fixed-bottom text-center py-3 bg-light">
        <p class="text-muted">
            <strong>
                <a href="{{ config('app.url') }}">© {{ config('app.name') }} {{ date('Y') }}</a>
            </strong>
            | Page rendered in {{ round(microtime(true) - LARAVEL_START, 4) }} seconds
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
