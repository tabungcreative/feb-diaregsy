@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Yudisium</h1>
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
                    <h4 class="mx-auto mt-4">Pendaftaran Yudisium</h4>
                    <p class="text-justify m-3">Pastikan kebenaran data diri Anda, kemudian masukan <span class="fw-bold">syarat-syarat dan dokumen pendaftaran</span>, </p>
                    <div class="card-body">

                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if(Session::has('update'))
                            <div class="alert alert-info" role="alert">
                                {{ Session::get('update') }}, pilih <span class="fw-bold">update pendaftaran</span> untuk mengubah data pendaftaran <br>
                                <a href="{{ route('yudisium.edit', old('nim')) }}" class="btn btn-primary">Update pendaftaran</a>
                                <button onClick="window.location.reload();" class="btn btn-danger">Batal</button>
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

                        <form action="{{ route('yudisium.register') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                            <input type="hidden" name="nama" value="{{ $mahasiswa['nama'] }}">
                            <input type="hidden" name="prodi" value="{{ $mahasiswa['prodi'] }}">
                            <div class="mb-3">
                                <label for="judul_skripsi" class="form-label fw-bolder">Judul Tugas Akhir</label>
                                <input type="text" name="judul_skripsi"
                                    class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                    placeholder="ex: 085xx" value="{{ $skripsi['judul_skripsi']}}" readonly>
                                @error('judul_skripsi')
                                <div id="judul_skripsi" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing1" class="form-label fw-bolder">Pembimbing 1</label>
                                <input type="text" name="pembimbing1"
                                    class="form-control @error('pembimbing1') is-invalid @enderror" id="pembimbing1"
                                    placeholder="ex: 085xx" value="{{ $skripsi['pembimbing1']}}" readonly>
                                @error('pembimbing1')
                                <div id="pembimbing1" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembimbing2" class="form-label fw-bolder">Pembimbing 2</label>
                                <input type="text" name="pembimbing2"
                                    class="form-control @error('pembimbing2') is-invalid @enderror" id="pembimbing2"
                                    placeholder="ex: 085xx" value="{{ $skripsi['pembimbing2'] }}" readonly>
                                @error('pembimbing2')
                                <div id="pembimbing2" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label fw-bolder">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                <div id="tanggal_mulai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_ujian" class="form-label fw-bolder">Tanggal Ujian</label>
                                <input type="date" name="tanggal_ujian"
                                class="form-control @error('tanggal_ujian') is-invalid @enderror" id="tanggal_ujian" value="{{ old('tanggal_ujian') }}">
                                @error('tanggal_ujian')
                                <div id="tanggal_ujian" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" value="L" id="jenis_kelamin" type="radio" name="jenis_kelamin" @if(old('jenis_kelamin') == 'L') checked @endif checked>
                                    <label class="form-check-label" for="flexRadioDefault1">laki - laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="P" id="jenis_kelamin" type="radio" name="jenis_kelamin" @if(old('jenis_kelamin') == 'P') checked @endif>
                                    <label class="form-check-label" for="flexRadioDefault2">perempuan</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="no_whatsapp" class="form-label fw-bolder">No Telephone (WA)</label>
                                <input type="text" name="no_whatsapp"
                                    class="form-control @error('no_whatsapp') is-invalid @enderror" id="no_whatsapp"
                                    placeholder="ex: 085xx" value="{{ old('no_whatsapp') }}">
                                @error('no_whatsapp')
                                <div id="no_whatsapp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ukuran_toga" class="form-label fw-bolder">Ukuran Toga</label>
                                <select class="form-select" name="ukuran_toga" id="ukuran_toga">
                                    <option value="">Pilih Ukuran Toga</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
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
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>
                                @error('bukti_pembayaran')
                                <div id="bukti_pembayaran" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_spp" class="form-label fw-bolder">Bebas Spp</label>
                                <input type="file" name="bebas_spp" class="form-control @error('bebas_spp') is-invalid @enderror" id="bebas_spp">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('bebas_spp')
                                <div id="bebas_spp" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="transkrip_nilai" class="form-label fw-bolder">Transkrip Nilai</label>
                                <input type="file" name="transkrip_nilai" class="form-control @error('transkrip_nilai') is-invalid @enderror" id="transkrip_nilai">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('transkrip_nilai')
                                <div id="transkrip_nilai" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_perpus" class="form-label fw-bolder">Bebas Pepustakaan</label>
                                <input type="file" name="bebas_perpus" class="form-control @error('bebas_perpus') is-invalid @enderror" id="bebas_perpus">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('bebas_perpus')
                                <div id="bebas_perpus" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="artikel" class="form-label fw-bolder">Artikel</label>
                                <input type="file" name="artikel" class="form-control @error('artikel') is-invalid @enderror" id="artikel">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('artikel')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file_skripsi" class="form-label fw-bolder">File Skripsi</label>
                                <input type="file" name="file_skripsi" class="form-control @error('file_skripsi') is-invalid @enderror" id="file_skripsi">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('file_skripsi')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bebas_plagiasi" class="form-label fw-bolder">Bebas Plagiasi</label>
                                <input type="file" name="bebas_plagiasi" class="form-control @error('bebas_plagiasi') is-invalid @enderror" id="bebas_plagiasi">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('bebas_plagiasi')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_penjilidan" class="form-label fw-bolder">Bukti Penjilidan</label>
                                <input type="file" name="bukti_penjilidan" class="form-control @error('bukti_penjilidan') is-invalid @enderror" id="bukti_penjilidan">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('bukti_penjilidan')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti_pengumpulan" class="form-label fw-bolder">Bukti Pengumpulan</label>
                                <input type="file" name="bukti_pengumpulan" class="form-control @error('bukti_pengumpulan') is-invalid @enderror" id="bukti_pengumpulan">
                                <small id="emailHelp" class="form-text text-danger">format <strong>.pdf</strong> , maksimal <strong>500kb</strong>.</small>

                                @error('bukti_pengumpulan')
                                <div id="artikel" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
