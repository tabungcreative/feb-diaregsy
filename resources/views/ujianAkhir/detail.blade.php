@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Ujian Skripsi </h1>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Detail pendaftaran Ujian Skripsi</h4>

                    <div class="card-body">

                        @if(Session::has('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

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
                                        <label for="inputPassword4">Email</label>
                                        <p class="fw-bold">{{ $ujianAkhir->email }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Judul Tugas Akhir</label>
                                        <p class="fw-bold"> {{ $ujianAkhir->judul_skripsi}} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Akta Kelahiran</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->akta_kelahiran)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Foto Ktp</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->ktp)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Ijazah Terakhir</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->ijazah_terakhir)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Kartu Keluarga</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->kartu_keluarga)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Lembar Bimbingan</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->lembar_bimbingan)}}" target="_blank"> preview </a></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nomer Telephone</label>
                                        <p class="fw-bold"> {{ $ujianAkhir->no_whatsapp }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ $mahasiswa['prodi'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tempat Lahir</label>
                                        <p class="fw-bold">{{ $mahasiswa['tempat_lahir'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Pembimbing</label>
                                        <p class="fw-bold">{{ $ujianAkhir->pembimbing1 }} </p>
                                        <p class="fw-bold">{{ $ujianAkhir->pembimbing2 }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Berkas Tugas Akhir</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->berkas_skripsi)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Sertifikat</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->sertifikat)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Slip Pembayaran Semester Terakhir</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->slip_pembayaransemesterterakhir)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Slip Pembayaran Skripsi</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->slip_pembayaranSkripsi)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Transkrip Nilai</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->transkrip_nilai)}}" target="_blank"> preview </a></p>
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
