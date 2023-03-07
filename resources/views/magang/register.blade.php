@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Kerja Praktik </h1>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-8 mx-auto">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src="{{asset('/img/logo-feb.png')}}" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src="{{asset('/img/logo-diaregsy.png')}}" class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Pendaftaran Kerja Praktik</h4>
                    <p class="text-justify m-3">Pastikan kebenaran data diri Anda, kemudian masukan <span class="fw-bold">syarat-syarat dan dokumen pendaftaran</span>, </p>

                    <div class="card-body">

                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if(Session::has('update'))
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('update') }}, pilih <span class="fw-bold">update pendaftaran</span> untuk mengubah data pendaftaran <br>
                                <a href="{{route('magang.edit', old('nim'))}}" class="btn btn-primary">Update pendaftaran</a>
                                <button onClick="window.location.reload();" class="btn btn-danger">Batal</button>
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

                        <form action="{{ route('magang.register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                            <input type="hidden" name="nama" value="{{ $mahasiswa['nama'] }}">
                            <input type="hidden" name="prodi" value="{{ $mahasiswa['prodi'] }}">

                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bolder">Alamat</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="ex: jalan dieng no 05" value="{{ old('alamat') }}">
                                @error('alamat')
                                <div id="alamat" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bolder">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email') }}">
                                @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="instsi_magang" class="form-label fw-bolder">Instansi Magang</label>
                                <input type="text" name="instansi_magang" class="form-control @error('instansi_magang') is-invalid @enderror" id="instansi_magang" placeholder="ex: instansi magang" value="{{ old('instansi_magang') }}">
                                @error('instansi_magang')
                                <div id="instansi_magang" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pimpinan_instansi" class="form-label fw-bolder">Pimpinan Instansi</label>
                                <input type="text" name="pimpinan_instansi" class="form-control @error('pimpinan_instansi') is-invalid @enderror" id="pimpinan_instansi" placeholder="ex: pimpinan instansi" value="{{ old('pimpinan_instansi') }}">
                                @error('pimpinan_instansi')
                                <div id="pimpinan_instansi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label fw-bolder">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                    placeholder="ex: 085xx" value="{{ old('no_whatsapp') }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lembar_persetujuan" class="form-label fw-bolder">Lembar Persetujuan</label>
                                <input type="file" name="lembar_persetujuan"
                                    class="form-control @error('lembar_persetujuan') is-invalid @enderror" id="lembar_persetujuan"
                                    placeholder="" value="{{ old('lembar_persetujuan') }}">
                                    <div class="text-danger fs-6 text">
                                        <strong>
                                            maximum upload file size : 500kb.
                                        </strong>
                                    </div>
                                @error('lembar_persetujuan')
                                <div id="lembar_persetujuan" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_pembayaran" class="form-label fw-bolder">Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                @error('bukti_pembayaran')
                                <div id="bukti_pembayaran" class="invalid-feedback">
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
