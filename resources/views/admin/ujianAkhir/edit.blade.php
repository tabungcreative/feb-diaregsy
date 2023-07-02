@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.ujianAkhir.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Ujian Tugas Akhir</h3>
                    <form action="{{ route('admin.ujianAkhir.update', $ujianAkhir->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bolder">Email</label>
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="ex: 085xx" value="{{ old('email',$ujianAkhir->email) }}">
                            @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label fw-bolder">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                                placeholder="ex: 085xx" value="{{ old('tempat_lahir',$ujianAkhir->tempat_lahir) }}">
                            @error('tempat_lahir')
                            <div id="tempat_lahir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bolder">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                                placeholder="ex: 085xx" value="{{ old('tanggal_lahir',$ujianAkhir->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                            <div id="tanggal_lahir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label fw-bolder">NIK</label>
                            <input type="text" name="nik"
                                class="form-control @error('nik') is-invalid @enderror" id="nik"
                                placeholder="ex: 085xx" value="{{ old('nik',$ujianAkhir->nik) }}">
                            @error('nik')
                            <div id="nik" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_skripsi" class="form-label fw-bolder">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi"
                                class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                placeholder="ex: 085xx" value="{{ old('judul_skripsi',$ujianAkhir->judul_skripsi) }}">
                            @error('judul_skripsi')
                            <div id="judul_skripsi" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing1" class="form-label fw-bolder">Pembimbing 1</label>
                            <select class="form-control" name="pembimbing1" id="pembimbing1">
                                <option selected>pilih pembimbing</option>
                                @foreach ($dosen as $data)
                                    <option value="{{ $data['nama'] }}" {{ ($data['nama'] == $ujianAkhir->pembimbing1) ? 'selected' : '' }} >{{$data['nama']}}</option>
                                @endforeach
                            </select>
                            @error('pembimbing1')
                            <div id="pembimbing1" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing2" class="form-label fw-bolder">Pembimbing 2</label>
                            <select class="form-control" name="pembimbing2" id="pembimbing2">
                                <option selected>pilih pembimbing</option>
                                @foreach ($dosen as $data)
                                    <option value="{{ $data['nama'] }}" {{ ($data['nama'] == $ujianAkhir->pembimbing2) ? 'selected' : '' }} >{{$data['nama']}}</option>
                                @endforeach
                            </select>
                            @error('pembimbing2')
                            <div id="pembimbing2" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_whatsapp" class="form-label fw-bolder">No Telephone (WA)</label>
                            <input type="text" name="no_whatsapp"
                                class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                placeholder="ex: 085xx" value="{{ old('no_whatsapp',$ujianAkhir->no_whatsapp) }}">
                            @error('no_whatsapp')
                            <div id="no_whatsapp" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="berkas_skripsi" class="form-label fw-bolder">File Skripsi</label>
                            <input type="file" name="berkas_skripsi"
                                class="form-control @error('berkas_skripsi') is-invalid @enderror" id="berkas_skripsi" placeholder="file skripsi" value="{{ old('berkas_skripsi') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->berkas_skripsi)}}" target="_blank"> preview </a>
                            @error('berkas_skripsi')
                            <div id="berkas_skripsi" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ijazah_terakhir" class="form-label fw-bolder">File Ijazah terakhir</label>
                            <input type="file" name="ijazah_terakhir"
                                class="form-control @error('ijazah_terakhir') is-invalid @enderror" id="ijazah_terakhir" placeholder="file skripsi" value="{{ old('ijazah_terakhir') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->ijazah_terakhir)}}" target="_blank"> preview </a>
                            @error('ijazah_terakhir')
                            <div id="ijazah_terakhir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="transkrip_nilai" class="form-label fw-bolder">File Transkrip Nilai</label>
                            <input type="file" name="transkrip_nilai"
                                class="form-control @error('transkrip_nilai') is-invalid @enderror" id="transkrip_nilai" placeholder="file skripsi" value="{{ old('transkrip_nilai') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->transkrip_nilai)}}" target="_blank"> preview </a>
                            @error('transkrip_nilai')
                            <div id="transkrip_nilai" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="akta_kelahiran" class="form-label fw-bolder">File Akta Kelahiran</label>
                            <input type="file" name="akta_kelahiran"
                                class="form-control @error('akta_kelahiran') is-invalid @enderror" id="akta_kelahiran" placeholder="file skripsi" value="{{ old('akta_kelahiran') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->akta_kelahiran)}}" target="_blank"> preview </a>
                            @error('akta_kelahiran')
                            <div id="akta_kelahiran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kartu_keluarga" class="form-label fw-bolder">File Kartu Keluarga</label>
                            <input type="file" name="kartu_keluarga"
                                class="form-control @error('kartu_keluarga') is-invalid @enderror" id="kartu_keluarga" placeholder="file skripsi" value="{{ old('kartu_keluarga') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->kartu_keluarga)}}" target="_blank"> preview </a>
                            @error('kartu_keluarga')
                            <div id="kartu_keluarga" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label fw-bolder">File Ktp</label>
                            <input type="file" name="ktp"
                                class="form-control @error('ktp') is-invalid @enderror" id="ktp"
                                placeholder="file skripsi" value="{{ old('ktp') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->ktp)}}" target="_blank"> preview </a>
                            @error('ktp')
                            <div id="ktp" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lembar_bimbingan" class="form-label fw-bolder">File Lembar Bimbingan</label>
                            <input type="file" name="lembar_bimbingan"
                                class="form-control @error('lembar_bimbingan') is-invalid @enderror" id="lembar_bimbingan" placeholder="file skripsi" value="{{ old('lembar_bimbingan') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->lembar_bimbingan)}}" target="_blank"> preview </a>
                            @error('lembar_bimbingan')
                            <div id="lembar_bimbingan" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slip_pembayaransemesterterakhir" class="form-label fw-bolder">Slip Pembayaran Semester Terakhir</label>
                            <input type="file" name="slip_pembayaransemesterterakhir"
                                class="form-control @error('slip_pembayaransemesterterakhir') is-invalid @enderror" id="slip_pembayaransemesterterakhir" placeholder="file skripsi" value="{{ old('slip_pembayaransemesterterakhir') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->slip_pembayaransemesterterakhir)}}" target="_blank"> preview </a>
                            @error('slip_pembayaransemesterterakhir')
                            <div id="slip_pembayaransemesterterakhir" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slip_pembayaranSkripsi" class="form-label fw-bolder">Slip Pembayaran Skripsi</label>
                            <input type="file" name="slip_pembayaranSkripsi"
                                class="form-control @error('slip_pembayaranSkripsi') is-invalid @enderror" id="slip_pembayaranSkripsi" placeholder="file skripsi" value="{{ old('slip_pembayaranSkripsi') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->slip_pembayaranSkripsi)}}" target="_blank"> preview </a>
                            @error('slip_pembayaranSkripsi')
                            <div id="slip_pembayaranSkripsi" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sertifikat" class="form-label fw-bolder">Sertifikat</label>
                            <input type="file" name="sertifikat"
                                class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikat"
                                placeholder="file skripsi" value="{{ old('sertifikat') }}">
                            <div class="text-danger fs-6 text">
                                <strong>
                                    maximum upload file size : 500kb.
                                </strong>
                            </div>
                            <a href="{{asset('storage/' . $ujianAkhir->sertifikat)}}" target="_blank"> preview </a>
                            @error('sertifikat')
                            <div id="sertifikat" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
