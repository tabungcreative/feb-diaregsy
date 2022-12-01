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
                    <h4 class="mx-auto mt-4">Pendaftaran Ujian Skripsi</h4>
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
                                <a href="{{ route('ujianAkhir.edit', old('nim')) }}" class="btn btn-primary">Update pendaftaran</a>
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

                        <form action="{{ route('ujianAkhir.register') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                            <input type="hidden" name="nama" value="{{ $mahasiswa['nama'] }}">
                            <input type="hidden" name="prodi" value="{{ $mahasiswa['prodi'] }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Mail</label>
                                <input type="text" name="email"
                                       class="form-control @error('email') is-invalid @enderror" id="email"
                                       placeholder="ex: 085xx" value="{{ old('email') }}">
                                @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir"
                                       class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                                       placeholder="ex: 085xx" value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                <div id="tempat_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                                       placeholder="ex: 085xx" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                <div id="tanggal_lahir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" name="nik"
                                       class="form-control @error('nik') is-invalid @enderror" id="nik"
                                       placeholder="ex: 085xx" value="{{ old('nik') }}">
                                @error('nik')
                                <div id="nik" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                                <input type="text" name="judul_skripsi"
                                       class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                       placeholder="ex: 085xx" value="{{ old('judul_skripsi') }}">
                                @error('judul_skripsi')
                                <div id="judul_skripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                                <input type="text" name="pembimbing1"
                                       class="form-control @error('pembimbing1') is-invalid @enderror" id="pembimbing1"
                                       placeholder="ex: 085xx" value="{{ old('pembimbing1') }}">
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
                                       placeholder="ex: 085xx" value="{{ old('pembimbing2') }}">
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
                                       placeholder="ex: 085xx" value="{{ old('no_whatsapp') }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="berkas_skripsi" class="form-label">File Skripsi</label>
                                <input type="file" name="berkas_skripsi"
                                       class="form-control @error('berkas_skripsi') is-invalid @enderror" id="berkas_skripsi"
                                       placeholder="file skripsi" value="{{ old('berkas_skripsi') }}">
                                @error('berkas_skripsi')
                                <div id="berkas_skripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ijazah_terakhir" class="form-label">File Ijazah terakhir</label>
                                <input type="file" name="ijazah_terakhir"
                                       class="form-control @error('ijazah_terakhir') is-invalid @enderror" id="ijazah_terakhir"
                                       placeholder="file skripsi" value="{{ old('ijazah_terakhir') }}">
                                @error('ijazah_terakhir')
                                <div id="ijazah_terakhir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transkrip_nilai" class="form-label">File Transkrip Nilai</label>
                                <input type="file" name="transkrip_nilai"
                                       class="form-control @error('transkrip_nilai') is-invalid @enderror" id="transkrip_nilai"
                                       placeholder="file skripsi" value="{{ old('transkrip_nilai') }}">
                                @error('transkrip_nilai')
                                <div id="transkrip_nilai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="akta_kelahiran" class="form-label">File Akta Kelahiran</label>
                                <input type="file" name="akta_kelahiran"
                                       class="form-control @error('akta_kelahiran') is-invalid @enderror" id="akta_kelahiran"
                                       placeholder="file skripsi" value="{{ old('akta_kelahiran') }}">
                                @error('akta_kelahiran')
                                <div id="akta_kelahiran" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kartu_keluarga" class="form-label">File Kartu Keluarga</label>
                                <input type="file" name="kartu_keluarga"
                                       class="form-control @error('kartu_keluarga') is-invalid @enderror" id="kartu_keluarga"
                                       placeholder="file skripsi" value="{{ old('kartu_keluarga') }}">
                                @error('kartu_keluarga')
                                <div id="kartu_keluarga" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ktp" class="form-label">File Ktp</label>
                                <input type="file" name="ktp"
                                       class="form-control @error('ktp') is-invalid @enderror" id="ktp"
                                       placeholder="file skripsi" value="{{ old('ktp') }}">
                                @error('ktp')
                                <div id="ktp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lembar_bimbingan" class="form-label">File Lembar Bimbingan</label>
                                <input type="file" name="lembar_bimbingan"
                                       class="form-control @error('lembar_bimbingan') is-invalid @enderror" id="lembar_bimbingan"
                                       placeholder="file skripsi" value="{{ old('lembar_bimbingan') }}">
                                @error('lembar_bimbingan')
                                <div id="lembar_bimbingan" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slip_pembayaransemesterterakhir" class="form-label">Slip Pembayaran Semester Terakhir</label>
                                <input type="file" name="slip_pembayaransemesterterakhir"
                                       class="form-control @error('slip_pembayaransemesterterakhir') is-invalid @enderror" id="slip_pembayaransemesterterakhir"
                                       placeholder="file skripsi" value="{{ old('slip_pembayaransemesterterakhir') }}">
                                @error('slip_pembayaransemesterterakhir')
                                <div id="slip_pembayaransemesterterakhir" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slip_pembayaranSkripsi" class="form-label">Slip Pembayaran Skripsi</label>
                                <input type="file" name="slip_pembayaranSkripsi"
                                       class="form-control @error('slip_pembayaranSkripsi') is-invalid @enderror" id="slip_pembayaranSkripsi"
                                       placeholder="file skripsi" value="{{ old('slip_pembayaranSkripsi') }}">
                                @error('slip_pembayaranSkripsi')
                                <div id="slip_pembayaranSkripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sertifikat" class="form-label">Sertifikat</label>
                                <input type="file" name="sertifikat"
                                       class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikat"
                                       placeholder="file skripsi" value="{{ old('sertifikat') }}">
                                @error('sertifikat')
                                <div id="sertifikat" class="invalid-feedback">
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
