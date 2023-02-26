@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Seminar Proposal </h1>
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
                    <h4 class="mx-auto mt-4">Detail pendaftaran Seminar Proposal</h4>

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
                                        <label for="inputPassword4">Judul Seminar Proposal</label>
                                        <p class="fw-bold"> {{ $sempro->judul_sempro }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Berkas Seminar Proposal</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $sempro->berkas_sempro)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Nota Kaprodi</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $sempro->nota_kaprodi)}}" target="_blank"> preview </a></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Bukti Pembayaran</label>
                                        <p class="fw-bold"><a href="{{asset('storage/' . $sempro->bukti_pembayaran)}}" target="_blank"> preview </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Nomer Telephone</label>
                                        <p class="fw-bold"> {{ $sempro->no_whatsapp }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Email</label>
                                        <p class="fw-bold"> {{ $sempro->email }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ $mahasiswa['prodi'] }} </p>
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
