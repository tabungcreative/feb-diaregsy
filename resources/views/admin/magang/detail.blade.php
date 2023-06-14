@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.magang.index') }}" class="btn btn-primary my-2"> Kembali </a>

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
                    <h6 class="font-weight-bold">Penempatan Magang</h6>
                    <form action="{{ route('admin.magang.add-tanggal-mulai', $magang->id) }}" class="mt-3" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Tanggal Mulai Magang</label>
                            <div class="input-group input-daterange">
                                <input type="date" name="tanggal_mulai" class="form-control" value="2012-04-05">
                                <div class="input-group-addon mx-2">to</div>
                                <input type="date" name="tanggal_selesai" class="form-control" value="2012-04-19">
                            </div>
                            {{-- <input type="date" name="tanggal_mulai" class="form-control" value="{{ $magang->tanggal_mulai }}" @if (!$magang->is_verify) disabled @endif> --}}
                            @error('pesan')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" @if (!$magang->is_verify) disabled @endif data-toggle="tooltip" data-placement="top" title="Tooltip on top">Atur Tanggal</button>
                    </form>
                    @if ($magang->tanggal_mulai !== null)
                        <div class="alert alert-primary mt-3" role="alert">
                            Penempatan magang dilaksanakan pada tanggal <strong>{{ Carbon\Carbon::parse($magang['tanggal_mulai'])->translatedFormat('d F Y') }}</strong>
                            sampai <strong>{{ Carbon\Carbon::parse($magang['tanggal_selesai'])->translatedFormat('d F Y') }}</strong>
                        </div>
                    @else
                        <div class="alert alert-warning mt-3" role="alert">
                            Tanggal Magang Belum Ditetapan
                        </div>
                    @endif
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="card-body">
                    <h6 class="font-weight-bold">Tambah Ketarangan / Pesan</h6>
                    <form action="{{ route('admin.magang.create-message', $magang->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Keterangan</label>
                            <textarea name="pesan"
                                class="form-control @error('pesan') is-invalid @enderror" id="pesan" rows="4">
                                {!! $magang->keterangan !!}
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
                    <h6 class="font-weight-bold">Detail Magang</h6>
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Status</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">
                                @if($magang->is_verify)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-warning">Belum Terverifikasi</span>
                                @endif
                            </p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Alamat</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $magang->alamat}}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Email</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $magang->email  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Nomer Telephon</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $magang->no_whatsapp  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Instansi Magang</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $magang->instansi_magang  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Pimpinan Instansi</h6>
                            </div>
                            <p class="mb-1 font-weight-bold">{{ $magang->pimpinan_instansi  }}</p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Bukti Pembayaran</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $magang->bukti_pembayaran)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Lembar Persetujuan</h6>
                            </div>
                            <p class="fw-bold"><a href="{{asset('storage/' . $magang->lembar_persetujuan)}}" target="_blank"><b> preview </b></a></p>
                        </div>
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <form method="post" action="{{ route('admin.magang.verify', $magang->id) }}" onSubmit="if(!confirm('Yakin ingin verifikasi pendaftaran ?')){return false;}">
                                @csrf
                                <button type="submit" class="btn btn-primary mx-1" @if ($magang->is_verify) disabled @endif>Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
