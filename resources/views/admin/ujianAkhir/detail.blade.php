@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.ujianAkhir.index') }}" class="btn btn-primary my-2"> Kembali </a>

    <div class="row mt-3 mb-5">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Detail Mahasiswa</h6>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">NIM</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['nim'] }}</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nama</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['nama'] }}</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Prodi</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['prodi'] }}</p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Tempat Lahir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['tempat_lahir'] }}</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Tambah Ketarangan / Pesan</h6>
                    <form action="{{ route('admin.ujianAkhir.create-message', $ujianAkhir->id) }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Keterangan</label>
                            <textarea name="pesan"
                                      class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="4">
                                {!! $ujianAkhir->keterangan !!}
                            </textarea>
                            @error('pesan')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Detail ujianAkhir</h6>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($ujianAkhir->is_verify)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Berlum Terverifikasi</span>
                                @endif
                            </p>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Telephon</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->no_whatsapp  }}</p>
                        </a>
                        {{-- <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">KTP</h6>
                            </div>
                            <embed src="{{ Storage::disk('s3')->url($ujianAkhir->foto_ktp) }}" width="100%" height="500px" />
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
