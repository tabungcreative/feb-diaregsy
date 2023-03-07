@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Yudisium </h1>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src={{asset('/img/logo-feb.png')}} class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src={{asset('/img/logo-diaregsy.png')}} class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Ubah data pendaftaran Yudisium</h4>

                    <div class="card-body">

                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">NIM</label>
                                        <p class="fw-bold"> {{ $mahasiswa['nim'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Nama</label>
                                        <p class="fw-bold"> {{ $mahasiswa['nama'] }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inputEmail4">Prodi</label>
                                        <p class="fw-bold"> {{ $mahasiswa['prodi'] }} </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">Tempat Lahir</label>
                                        <p class="fw-bold">{{ $mahasiswa['tempat_lahir'] }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('yudisium.update', $yudisium->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                                <input type="text" name="judul_skripsi"
                                    class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                    placeholder="ex: 085xx" value="{{ old('judul_skripsi',$yudisium->judul_skripsi) }}">
                                @error('judul_skripsi')
                                <div id="judul_skripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                                <input type="text" name="pembimbing1"
                                    class="form-control @error('pembimbing1') is-invalid @enderror" id="pembimbing1"
                                    placeholder="ex: 085xx" value="{{ old('pembimbing1',$yudisium->pembimbing1) }}">
                                @error('pembimbing1')
                                <div id="pembimbing1" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                                <input type="text" name="pembimbing2"
                                    class="form-control @error('pembimbing2') is-invalid @enderror" id="pembimbing2"
                                    placeholder="ex: 085xx" value="{{ old('pembimbing2',$yudisium->pembimbing2) }}">
                                @error('pembimbing2')
                                <div id="pembimbing2" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai"
                                    placeholder="ex: 085xx" value="{{ old('tanggal_mulai',$yudisium->tanggal_mulai) }}">
                                @error('tanggal_mulai')
                                <div id="tanggal_mulai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_ujian" class="form-label">Tanggal Ujian</label>
                                <input type="date" name="tanggal_ujian"
                                    class="form-control @error('tanggal_ujian') is-invalid @enderror" id="tanggal_ujian"
                                    placeholder="ex: 085xx" value="{{ old('tanggal_ujian',$yudisium->tanggal_ujian) }}">
                                @error('tanggal_ujian')
                                <div id="tanggal_ujian" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" value="L" id="jenis_kelamin" type="radio"       name="jenis_kelamin" @if(old('jenis_kelamin',$yudisium->jenis_kelamin) == 'L') checked @endif checked>
                                    <label class="form-check-label" for="flexRadioDefault1">laki - laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="P" id="jenis_kelamin" type="radio" name="jenis_kelamin" @if(old('jenis_kelamin',$yudisium->jenis_kelamin) == 'P') checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault2">perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                <div id="jenis_kelamin" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                    placeholder="ex: 085xx" value="{{ old('no_whatsapp',$yudisium->no_whatsapp) }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ukuran_toga" class="form-label">Ukuran Toga</label>
                                <select class="form-control" id="ukuran_toga" name="ukuran_toga" required="required">
                                    <option selected>Pilih Ukuran Toga</option>
                                    <option value="S" {{ old('prodi',$yudisium->ukuran_toga) == "S" ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ old('prodi',$yudisium->ukuran_toga) == "M" ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ old('prodi',$yudisium->ukuran_toga) == "L" ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ old('prodi',$yudisium->ukuran_toga) == "XL" ? 'selected' : '' }}>XL</option>
                                </select>
                                @error('ukuran_toga')
                                <div id="ukuran_toga" class="invalid-feedback">
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
                                <a href="{{asset('storage/' . $yudisium->bukti_pembayaran)}}" target="_blank"> preview </a>
                                @error('bukti_pembayaran')
                                <div id="bukti_pembayaran" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_spp" class="form-label fw-bolder">Bebas Spp</label>
                                <input type="file" name="bebas_spp" class="form-control @error('bebas_spp') is-invalid @enderror" id="bebas_spp">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->bebas_spp)}}" target="_blank"> preview </a>
                                @error('bebas_spp')
                                <div id="bebas_spp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transkrip_nilai" class="form-label fw-bolder">Transkrip Nilai</label>
                                <input type="file" name="transkrip_nilai" class="form-control @error('transkrip_nilai') is-invalid @enderror" id="transkrip_nilai">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->transkrip_nilai)}}" target="_blank"> preview </a>
                                @error('transkrip_nilai')
                                <div id="transkrip_nilai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_perpus" class="form-label fw-bolder">Bebas Pepustakaan</label>
                                <input type="file" name="bebas_perpus" class="form-control @error('bebas_perpus') is-invalid @enderror" id="bebas_perpus">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->bebas_perpus)}}" target="_blank"> preview </a>
                                @error('bebas_perpus')
                                <div id="bebas_perpus" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="artikel" class="form-label fw-bolder">Artikel</label>
                                <input type="file" name="artikel" class="form-control @error('artikel') is-invalid @enderror" id="artikel">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->artikel)}}" target="_blank"> preview </a>
                                @error('artikel')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file_skripsi" class="form-label fw-bolder">File Skripsi</label>
                                <input type="file" name="file_skripsi" class="form-control @error('file_skripsi') is-invalid @enderror" id="file_skripsi">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->file_skripsi)}}" target="_blank"> preview </a>
                                @error('file_skripsi')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_plagiasi" class="form-label fw-bolder">Bebas Plagiasi</label>
                                <input type="file" name="bebas_plagiasi" class="form-control @error('bebas_plagiasi') is-invalid @enderror" id="bebas_plagiasi">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->bebas_plagiasi)}}" target="_blank"> preview </a>
                                @error('bebas_plagiasi')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_penjilidan" class="form-label fw-bolder">Bukti Penjilidan</label>
                                <input type="file" name="bukti_penjilidan" class="form-control @error('bukti_penjilidan') is-invalid @enderror" id="bukti_penjilidan">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->bukti_penjilidan)}}" target="_blank"> preview </a>
                                @error('bukti_penjilidan')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_pengumpulan" class="form-label fw-bolder">Bukti Pengumpulan</label>
                                <input type="file" name="bukti_pengumpulan" class="form-control @error('bukti_pengumpulan') is-invalid @enderror" id="bukti_pengumpulan">
                                <div class="text-danger fs-6 text">
                                    <strong>
                                        maximum upload file size : 500kb.
                                    </strong>
                                </div>
                                <a href="{{asset('storage/' . $yudisium->bukti_pengumpulan)}}" target="_blank"> preview </a>
                                @error('bukti_pengumpulan')
                                <div id="artikel" class="invalid-feedback">
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
    </div>
@endsection
