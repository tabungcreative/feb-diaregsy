@extends("layouts.app")
@inject('carbon', 'Carbon\Carbon')

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Yudisium </h1>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src={{asset('/img/logo-feb.png')}} class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src={{asset('/img/diaregsy-feb.png')}} class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Detail pendaftaran Yudisium</h4>

                    <div class="card-body">

                        @if(Session::has('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="alert alert-warning" role="alert">
                            Mahasiswa yang telah terdaftar diwajibkan bergabung ke grup Yudisiusm yang telah tersedia, berikut link untuk bergabung : <a href="{{ $groupYudisium->link ?? '#'}}" target="_blank"><i class="fas fa-external-link-alt"></i> {{ $groupYudisium->nama ?? 'link' }}</a>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">NIM</label>
                                        <p class="fw-bold"> {{ $mahasiswa['nim'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Nama</label>
                                        <p class="fw-bold"> {{ $mahasiswa['nama'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Judul Tugas Akhir</label>
                                        <p class="fw-bold"> {{ $yudisium->judul_skripsi}} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tanggal Mulai Tugas Akhir</label>
                                        <p class="fw-bold"> {{ $carbon::parse($yudisium->tanggal_mulai)->translatedFormat('d F Y')}} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tanggal Ujian Tugas Akhir</label>
                                        <p class="fw-bold"> {{ $carbon::parse($yudisium->tanggal_ujian)->translatedFormat('d F Y')}} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bukti Pembayaran</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bukti_pembayaran)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bebas Spp</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_spp)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Transkrip Nilai</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->transkrip_nilai)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bebas Spp</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_spp)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nomer Telephone</label>
                                        <p class="fw-bold"> {{ $yudisium->no_whatsapp }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ $mahasiswa['prodi'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Pembimbing</label>
                                        <p class="fw-bold">{{ $yudisium->pembimbing1 }} </p>
                                        <p class="fw-bold">{{ $yudisium->pembimbing2 }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Ukuran Toga</label>
                                        <p class="fw-bold"> {{ $yudisium->ukuran_toga}} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Artikel</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->artikel)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Berkas Tugas Akhir</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->file_skripsi)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bebas Plagiasi</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_plagiasi)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bukti Penjilidan</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bukti_penjilidan)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bebas Perpustakaan</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_perpus)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Preview </a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
