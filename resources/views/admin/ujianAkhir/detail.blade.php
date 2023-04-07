@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.ujianAkhir.index') }}" class="btn btn-primary my-2"> Kembali </a>

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
                    <h6 class="font-weight-bold">Detail Ujian Tugas Akhir</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($ujianAkhir->is_verify)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Belum Terverifikasi</span>
                                @endif
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Telephon</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->no_whatsapp  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Tempat Lahir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->tempat_lahir }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Tanggal Lahir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->tanggal_lahir }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Induk Kewarganegaraan (NIK)</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->nik }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Judul Tugas Akhir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->judul_skripsi }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing 1</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->pembimbing1  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing2</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $ujianAkhir->pembimbing2  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Berkas Tugas Akhir</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->berkas_skripsi)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Ijazah Terakhir</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->ijazah_terakhir)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Transkrip Nilai</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->transkrip_nilai)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Akta Kelahiran</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->akta_kelahiran)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Kartu Keluarga</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->kartu_keluarga)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Foto KTP</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->ktp)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Lembar Bimbingan</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->lembar_bimbingan)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Slip Pembayaran Semester Terakhir</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->slip_pembayaransemesterterakhir)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Slip Pembayaran Tugas Akhir</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->slip_pembayaranSkripsi)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Sertifikat</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $ujianAkhir->sertifikat)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
