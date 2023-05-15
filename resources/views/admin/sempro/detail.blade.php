@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.sempro.index') }}" class="btn btn-primary my-2"> Kembali </a>

    <div class="row mt-3 mb-5">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Detail Mahasiswa</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">NIM</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['nim'] }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nama</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['nama'] }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Prodi</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $mahasiswa['prodi'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Status Pendaftaran</h6>
                    <form action="{{ route('admin.sempro.update-status', $sempro->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <select class="form-control" name="status" @if (!$sempro->is_verify) disabled @endif>
                                <option value="Proses Pengajuan" @if($sempro->status == 'Proses Pengajuan') selected @endif>Proses Pengajuan</option>
                                <option value="Penjadwalan Seminar" @if($sempro->status == 'Penjadwalan Seminar') selected @endif>Penjadwalan Seminar</option>
                                <option value="Lulus" @if($sempro->status == 'Lulus') selected @endif>Lulus</option>
                                <option value="Tidak Lulus" @if($sempro->status == 'Tidak Lulus') selected @endif>Tidak Lulus</option>
                            </select>
                            @error('jenis_pendaftaran')
                            <div id="jenis_pendaftaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" @if (!$sempro->is_verify) disabled @endif>Ubah Status Pendaftaran</button>
                    </form>

                    <form action="{{ route('admin.sempro.add-tanggal-seminar', $sempro->id) }}" class="mt-3" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Jadwal Seminar</label>
                            <input type="date" name="tanggal_seminar" class="form-control" value="{{ $sempro->tanggal_seminar }}" @if ($sempro->status != 'Penjadwalan Seminar') disabled @endif>
                            @error('pesan')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" @if ($sempro->status != 'Penjadwalan Seminar') disabled @endif data-toggle="tooltip" data-placement="top" title="Tooltip on top">Atur Jadwal</button>
                    </form>
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Tambah Ketarangan / Pesan</h6>
                    <form action="{{ route('admin.sempro.create-message', $sempro->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Keterangan</label>
                            <textarea name="pesan"
                                class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="4">
                                {!! $sempro->keterangan !!}
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
                    <h6 class="font-weight-bold">Detail seminar proposal</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($sempro->is_verify)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Belum Terverifikasi</span>
                                @endif
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Email</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $sempro->email  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Telephon</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $sempro->no_whatsapp  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Judul seminar proposal</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $sempro->judul_sempro  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nota Dinas Kaprodi</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                <a href="{{asset('storage/' . $sempro->nota_kaprodi)}}" target="_blank"> File </a>
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Berkas Sempro</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                <a href="{{asset('storage/' . $sempro->berkas_sempro)}}" target="_blank" >File</a>
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Pembayaran</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                <a href="{{asset('storage/' . $sempro->bukti_pembayaran)}}" target="_blank" >File</a>
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <form method="post" action="{{ route('admin.sempro.verify', $sempro->id) }}" onSubmit="if(!confirm('Yakin ingin verifikasi pendaftaran ?')){return false;}">
                                @csrf
                                <button type="submit" class="btn btn-primary mx-1" @if ($sempro->is_verify) disabled @endif>Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
