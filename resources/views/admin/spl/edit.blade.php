@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.spl.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Studi Ekskursi</h3>
                    <form action="{{ route('admin.spl.update', $spl->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label fw-bolder">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                    placeholder="ex: 085xx" value="{{ $spl->no_whatsapp }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_pendaftaran" class="form-label fw-bolder">Jenis Pendaftaran</label>
                                <select class="form-control" name="jenis_pendaftaran">
                                    <option value="">Jenis Pendaftaran</option>
                                    <option value="kip" @if($spl->jenis_pendaftaran == 'kip') selected @endif>KIP</option>
                                    <option value="reguler" @if($spl->jenis_pendaftaran == 'reguler') selected @endif>Reguler</option>
                                </select>
                                @error('jenis_pendaftaran')
                                <div id="jenis_pendaftaran" class="invalid-feedback">
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
                                <a href="{{asset('storage/' . $spl->bukti_pembayaran)}}" target="_blank"> preview </a>
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
