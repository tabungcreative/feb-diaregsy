@extends("layouts.app")

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
                        <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Ubah data pendaftaran Yudisium</h4>

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

                        <form action="{{ route('yudisium.update', $yudisium->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                          <div class="mb-3">
                                <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                                <input type="text" name="judul_skripsi"
                                    class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                    placeholder="ex: 085xx" value="{{ old('judul_skripsi',$yudisium->judul_skripsi) }}">
                                @error('judul_skripsi')
                                <div id="judul_skripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai"
                                placeholder="ex: 085xx" value="{{ old('tanggal_mulai',$yudisium->tanggal_mulai) }}">
                                @error('tanggal_mulai')
                                <div id="tanggal_mulai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_ujian" class="form-label">Tanggal Ujian</label>
                                <input type="date" name="tanggal_ujian"
                                class="form-control @error('tanggal_ujian') is-invalid @enderror" id="tanggal_ujian"
                                placeholder="ex: 085xx" value="{{ old('tanggal_ujian',$yudisium->tanggal_ujian) }}">
                                @error('tanggal_ujian')
                                <div id="tanggal_ujian" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin"
                                       class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                       placeholder="ex: 085xx" value="{{ old('jenis_kelamin',$yudisium->jenis_kelamin) }}">
                                @error('jenis_kelamin')
                                <div id="jenis_kelamin" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                                <input type="text" name="pembimbing1"
                                       class="form-control @error('pembimbing1') is-invalid @enderror" id="pembimbing1"
                                       placeholder="ex: 085xx" value="{{ old('pembimbing1',$yudisium->pembimbing1) }}">
                                @error('pembimbing1')
                                <div id="pembimbing1" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                                <input type="text" name="pembimbing2"
                                       class="form-control @error('pembimbing2') is-invalid @enderror" id="pembimbing2"
                                       placeholder="ex: 085xx" value="{{ old('pembimbing2',$yudisium->pembimbing2) }}">
                                @error('pembimbing2')
                                <div id="pembimbing2" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                       class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                       placeholder="ex: 085xx" value="{{ old('no_whatsapp',$yudisium->no_whatsapp) }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ukuran_toga" class="form-label">Ukuran Toga</label>
                                <input type="text" name="ukuran_toga"
                                       class="form-control @error('ukuran_toga') is-invalid @enderror" id="ukuran_toga"
                                       placeholder="ex: 085xx" value="{{ old('ukuran_toga',$yudisium->ukuran_toga) }}">
                                @error('ukuran_toga')
                                <div id="ukuran_toga" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto_ktp" class="form-label">Foto KTP</label>
                                <input type="file" name="foto_ktp"
                                       class="form-control @error('foto_ktp') is-invalid @enderror" id="foto_ktp"
                                       placeholder="foto" value="{{ old('foto_ktp') }}">
                                @error('foto_ktp')
                                <div id="foto_ktp" class="invalid-feedback">
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
