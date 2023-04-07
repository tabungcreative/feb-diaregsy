@extends('layouts.admin')
@inject('carbon', 'Carbon\Carbon')

@section('content')
    <a href="{{ route('admin.yudisium.index') }}" class="btn btn-primary my-2"> Kembali </a>

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
                    <form action="{{ route('admin.yudisium.create-message', $yudisium->id) }}" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Keterangan</label>
                            <textarea name="pesan"
                                class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="4">
                                {!! $yudisium->keterangan !!}
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
                    <h6 class="font-weight-bold">Detail yudisium</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($yudisium->is_verify)
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
                            <p class="mb-1 font-weight-bold">{{ $yudisium->no_whatsapp  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Judul Tugas Akhir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $yudisium->judul_skripsi  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Tanggal Mulai Tugas Akhir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $carbon::parse($yudisium->tanggal_mulai)->translatedFormat('d F Y')}}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Tanggal Ujian Tugas Akhir</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $carbon::parse($yudisium->tanggal_ujian)->translatedFormat('d F Y')}}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Jenis Kelamin</h6>
                            </div>
                            @if($yudisium->jenis_kelamin == "L")
                                <p class="mb-1 font-weight-bold">Laki-laki</p>
                            @else
                                <span class="badge badge-warning">Perempuan</span>
                            @endif
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Ukuran Toga</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $yudisium->ukuran_toga  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing 1</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $yudisium->pembimbing1  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pembimbing2</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $yudisium->pembimbing2  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Pembayaran</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bukti_pembayaran)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bebas Spp</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_spp)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Transkrip Nilai</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->transkrip_nilai)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bebas Perpustakaan</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_perpus)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Artikel</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->artikel)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Berkas Tugas Akhir</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->file_skripsi)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bebas Plagiasi</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bebas_plagiasi)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Penjilidan</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bukti_penjilidan)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Pengumpulan</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $yudisium->bukti_pengumpulan)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
