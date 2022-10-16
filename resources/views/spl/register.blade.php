@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-info text-center text-white">
            <h1>SPL (Studi Pengembangan Lapangan) </h1>
        </div>
    </div>
    <div class="row py-5">
        <div class="col-md-5 mx-auto">
            <div class="card p-4">
                <div class="image mx-auto">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="200px">
                </div>
                <h4 class="mx-auto mt-4">Pendaftaran SPL (Studi Pengembangan Lapangan) </h4>
                <p class="text-justify m-3">Pastikan kebenaran data diri Anda, kemudian masukan <span class="fw-bold">no pembayaran, syarat-syarat dan dokumen pendaftaran</span>, </p>

                <div class="card-body">

                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if(Session::has('update'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('update') }}, pilih <span class="fw-bold">update pendaftaran</span> untuk mengubah data pendaftaran <br>
                            <a href="#" class="btn btn-primary">Update pendaftaran</a>
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

                    <form action="{{ route('spl.register') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                        <input type="hidden" name="nama" value="{{ $mahasiswa['nama'] }}">
                        <input type="hidden" name="prodi" value="{{ $mahasiswa['prodi'] }}">

                        <div class="mb-3">
                            <label for="no_pembayaran" class="form-label">No Pembayaran</label>
                            <input type="text" name="no_pembayaran"
                                   class="form-control @error('no_pembayaran') is-invalid @enderror" id="no_pembayaran"
                                   placeholder="SMP-10.10.001" value="{{ old('no_pembayaran') }}">
                            @error('no_pembayaran')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_whatsapp" class="form-label">No Telephone (WA)</label>
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
                            <label for="jenis_pendaftaran" class="form-label">Jenis Pendaftaran</label>
                            <select class="form-control" name="jenis_pendaftaran">
                                <option value="">Jenis Pendaftaran</option>
                                <option value="kip">KIP</option>
                                <option value="reguler">Reguler</option>

                            </select>
                            @error('jenis_pendaftaran')
                                <div id="jenis_pendaftaran" class="invalid-feedback">
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
@endsection
