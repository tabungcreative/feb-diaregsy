@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.kompre.index') }}" class="btn btn-primary my-2"> Kembali </a>

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
                    <form action="{{ route('admin.kompre.update-status', $kompre->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <select class="form-control" name="status" @if (!$kompre->is_verify) disabled @endif>
                                <option value="Proses Pengajuan" @if($kompre->status == 'Proses Pengajuan') selected @endif>Proses Pengajuan</option>
                                <option value="Penjadwalan Ujian" @if($kompre->status == 'Penjadwalan Ujian') selected @endif>Penjadwalan Ujian</option>
                                <option value="Lulus" @if($kompre->status == 'Lulus') selected @endif>Lulus</option>
                                <option value="Tidak Lulus" @if($kompre->status == 'Tidak Lulus') selected @endif>Tidak Lulus</option>
                            </select>
                            @error('jenis_pendaftaran')
                            <div id="jenis_pendaftaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" @if (!$kompre->is_verify) disabled @endif>Ubah Status Pendaftaran</button>
                    </form>

                    <form action="{{ route('admin.kompre.add-tanggal-ujian', $kompre->id) }}" class="mt-3" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Jadwal Ujian</label>
                            <input type="date" name="tanggal_ujian" class="form-control" value="{{ $kompre->tanggal_ujian }}" @if ($kompre->status != 'Penjadwalan Ujian') disabled @endif>
                            @error('pesan')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" @if ($kompre->status != 'Penjadwalan Ujian') disabled @endif data-toggle="tooltip" data-placement="top" title="Tooltip on top">Atur Jadwal</button>
                    </form>
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Tambah Ketarangan / Pesan</h6>
                    <form action="{{ route('admin.kompre.create-message', $kompre->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Keterangan</label>
                            <textarea name="pesan"
                                class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="4">
                                {!! $kompre->keterangan !!}
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
                    <h6 class="font-weight-bold">Detail ujian komprehensif</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($kompre->is_verify)
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
                            <p class="mb-1 font-weight-bold">{{ $kompre->email  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Telephon</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $kompre->no_whatsapp  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing 1</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $kompre->pembimbing1  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing 2</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $kompre->pembimbing2  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Pembayaran</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $kompre->bukti_pembayaran)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <form method="post" action="{{ route('admin.kompre.verify', $kompre->id) }}" onSubmit="if(!confirm('Yakin ingin verifikasi pendaftaran ?')){return false;}">
                                @csrf
                                <button type="submit" class="btn btn-primary mx-1" @if ($kompre->is_verify) disabled @endif>Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
