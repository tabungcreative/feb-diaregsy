@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Bimbingan Skripsi </h1>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src="{{asset('/img/logo-feb.png')}}" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src="{{asset('/img/logo-diaregsy.png')}}" class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Detail pendaftaran bimbingan skripsi</h4>

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
                                        <p class="fw-bold">{{ $bimbinganSkripsi->email }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Judul Skripsi</label>
                                        <p class="fw-bold">{{ $bimbinganSkripsi->judul_skripsi }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bukti Pembayaran</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $bimbinganSkripsi->bukti_pembayaran)}}" target="_blank"> preview </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nomer Telephone</label>
                                        <p class="fw-bold"> {{ $bimbinganSkripsi->no_whatsapp }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ ucwords($mahasiswa['prodi']) }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tempat Lahir</label>
                                        <p class="fw-bold">{{ $mahasiswa['tempat_lahir'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Pembimbing</label>
                                        <p class="fw-bold">{{ $bimbinganSkripsi->pembimbing1 }} </p>
                                        <p class="fw-bold">{{ $bimbinganSkripsi->pembimbing2 }} </p>
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
