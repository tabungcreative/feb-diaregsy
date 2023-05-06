@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.magang.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Kerja Praktik</h3>
                    <form action="{{ route('admin.magang.update', $magang->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bolder">Alamat</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="ex: jalan dieng no 05" value="{{ old('alamat',$magang->alamat) }}">
                                @error('alamat')
                                <div id="alamat" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bolder">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email',$magang->email) }}">
                                @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="instsi_magang" class="form-label fw-bolder">Instansi Magang</label>
                                <input type="text" name="instansi_magang" class="form-control @error('instansi_magang') is-invalid @enderror" id="instansi_magang" placeholder="ex: instansi magang" value="{{ old('instansi_magang',$magang->instansi_magang) }}">
                                @error('instansi_magang')
                                <div id="instansi_magang" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pimpinan_instansi" class="form-label fw-bolder">Pimpinan Instansi</label>
                                <input type="text" name="pimpinan_instansi" class="form-control @error('pimpinan_instansi') is-invalid @enderror" id="pimpinan_instansi" placeholder="ex: pimpinan instansi" value="{{ old('pimpinan_instansi',$magang->pimpinan_instansi) }}">
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
                                    placeholder="ex: 085xx" value="{{ old('no_whatsapp',$magang->no_whatsapp) }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lembar_persetujuan" class="form-label fw-bolder">Lembar Persetujuan</label>
                                <input type="file" name="lembar_persetujuan" class="form-control @error('lembar_persetujuan') is-invalid @enderror" id="lembar_persetujuan" placeholder="foto" value="{{ old('lembar_persetujuan') }}">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $magang->bukti_pembayaran)}}" target="_blank"> preview </a>
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
                                <a href="{{asset('storage/' . $magang->bukti_pembayaran)}}" target="_blank"> preview </a>
                                @error('bukti_pembayaran')
                                <div id="bukti_pembayaran" class="invalid-feedback">
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
