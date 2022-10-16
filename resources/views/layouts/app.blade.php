<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Diaregsi | Layanan Pendaftaran Mahasiswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        {{-- fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt="logo-diaregsi" width="80px">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="150px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pendaftaran
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">SPL</a></li>
                        <li><a class="dropdown-item" href="#">Magang</a></li>
                        <li><a class="dropdown-item" href="#">Sempro</a></li>
                        <li><a class="dropdown-item" href="#">Kompre</a></li>
                        <li><a class="dropdown-item" href="#">Bimbingan Skripsi</a></li>
                        <li><a class="dropdown-item" href="#">Ujian Skripsi</a></li>
                        <li><a class="dropdown-item" href="#">Yudisium</a></li>
                        <li><a class="dropdown-item" href="#">Mengulang</a></li>
                        <li><a class="dropdown-item" href="#">Semester Pendek</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
{{-- 
        <!-- banner -->
        <div class="container pt-5">
            <div class="row mt-5 banner">
                <div class="col-md-6">
                    <h1 class="text-dark">Diaregsi FEB</h1>
                    <p class="text-black-50">
                        Daftarkan Keperluan akademik kamu disini
                    </p>
                    <a href="#" class="btn btn-danger text-white shadow mt-4">Daftar Sekarang</a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('img/banner.svg') }}" alt="" class="img-fluid" width="400px"/>
                </div>
            </div>
        </div>
        <!-- //banner --> --}}
        
        @yield('content')

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>