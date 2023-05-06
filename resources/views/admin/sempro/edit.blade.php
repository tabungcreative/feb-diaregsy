@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.sempro.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Seminar Proposal</h3>
                    <form action="{{ route('admin.sempro.update', $sempro->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bolder">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email',$sempro->email) }}">
                                @error('email')
                                <div id="email" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label fw-bolder">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                    placeholder="ex: 085xx" value="{{ old('no_whatsapp',$sempro->no_whatsapp) }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="judul_sempro" class="form-label fw-bolder">Judul Seminar Proposal</label>
                                <input type="text" name="judul_sempro"
                                    class="form-control @error('judul_sempro') is-invalid @enderror" id="judul_sempro"
                                    placeholder="ex: judul seminar proposal" value="{{ old('judul_sempro',$sempro->judul_sempro) }}">
                                @error('judul_sempro')
                                <div id="judul_sempro" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nota_kaprodi" class="form-label fw-bolder">Nota Dinas Kaprodi</label>
                                <input type="file" name="nota_kaprodi"
                                    class="form-control @error('nota_kaprodi') is-invalid @enderror" id="nota_kaprodi"
                                    placeholder="foto" value="{{ old('nota_kaprodi') }}">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $sempro->nota_kaprodi)}}" target="_blank"> Preview </a>
                                @error('nota_kaprodi')
                                <div id="nota_kaprodi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="berkas_sempro" class="form-label fw-bolder">Berkas Seminar Proposal</label>
                                <input type="file" name="berkas_sempro"
                                    class="form-control @error('berkas_sempro') is-invalid @enderror" id="berkas_sempro" placeholder="foto" value="{{ old('berkas_sempro') }}">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $sempro->berkas_sempro)}}" target="_blank"> Preview </a>
                                @error('berkas_sempro')
                                <div id="berkas_sempro" class="invalid-feedback">
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
                                <a href="{{asset('storage/' . $sempro->bukti_pembayaran)}}" target="_blank"> Preview </a>
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
