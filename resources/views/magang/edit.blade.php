@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Magang </h1>
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
                    <h4 class="mx-auto mt-4">Ubah data pendaftaran Magang</h4>

                    <div class="card-body">

                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
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
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ $mahasiswa['prodi'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tempat Lahir</label>
                                        <p class="fw-bold">{{ $mahasiswa['tempat_lahir'] }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('magang.update', $magang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="no_pembayaran" class="form-label">No Pembayaran</label>
                            <input type="text" name="no_pembayaran"
                                    class="form-control" id="no_pembayaran"
                                    placeholder="SMP-10.10.001" value="{{ old('no_pembayaran') }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="ex: jalan dieng no 05" value="{{ old('alamat',$magang->alamat) }}">
                            @error('alamat')
                            <div id="alamat" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email',$magang->email) }}">
                            @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="instsi_magang" class="form-label">Instansi Magang</label>
                            <input type="text" name="instansi_magang" class="form-control @error('instansi_magang') is-invalid @enderror" id="instansi_magang" placeholder="ex: instansi magang" value="{{ old('instansi_magang',$magang->instansi_magang) }}">
                            @error('instansi_magang')
                            <div id="instansi_magang" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pimpinan_instansi" class="form-label">Pimpinan Instansi</label>
                            <input type="text" name="pimpinan_instansi" class="form-control @error('pimpinan_instansi') is-invalid @enderror" id="pimpinan_instansi" placeholder="ex: pimpinan instansi" value="{{ old('pimpinan_instansi',$magang->pimpinan_instansi) }}">
                            @error('pimpinan_instansi')
                            <div id="pimpinan_instansi" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_whatsapp" class="form-label">No Telephone (WA)</label>
                            <input type="text" name="no_whatsapp"
                                   class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                   placeholder="ex: 085xx" value="{{ old('no_whatsapp',$magang->no_whatsapp) }}">
                            @error('no_whatsapp')
                            <div id="no_whatsapp" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lembar_persetujuan" class="form-label">Lembar Persetujuan</label>
                            <input type="file" name="lembar_persetujuan" class="form-control @error('lembar_persetujuan') is-invalid @enderror" id="lembar_persetujuan" placeholder="foto" value="{{ old('lembar_persetujuan') }}">
                            <a href="{{Storage::disk('s3')->url($magang->lembar_persetujuan)}}" target="_blank"> preview </a>
                            @error('lembar_persetujuan')
                            <div id="lembar_persetujuan" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
