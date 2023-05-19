@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.kompre.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Ujian Komprehensif</h3>
                    <form action="{{ route('admin.kompre.update', $kompre->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bolder">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email',$kompre->email) }}">
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
                                placeholder="ex: 085xx" value="{{ old('no_whatsapp',$kompre->no_whatsapp) }}">
                            @error('no_whatsapp')
                            <div id="no_whatsapp" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing1" class="form-label fw-bolder">Pembimbing 1</label>
                            <select class="form-control" name="pembimbing1" id="pembimbing1">
                                <option selected>pilih pembimbing</option>
                                @foreach ($dosen as $data)
                                    <option value="{{ $data['nama'] }}" {{ ($data['nama'] == $kompre->pembimbing1) ? 'selected' : '' }} >{{$data['nama']}}</option>
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
                                <option value="{{ $data['nama'] }}" {{ ($data['nama'] == $kompre->pembimbing2) ? 'selected' : '' }} >{{$data['nama']}}</option>
                                @endforeach
                            </select>
                            @error('pembimbing2')
                            <div id="pembimbing2" class="invalid-feedback">
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
                            <a href="{{asset('storage/' . $kompre->bukti_pembayaran)}}" target="_blank"> preview </a>
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
