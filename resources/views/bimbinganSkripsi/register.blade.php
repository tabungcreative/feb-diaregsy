@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="p-5 bg-danger text-center text-white">
            <h1>Bimbingan Skripsi </h1>
        </div>
    </div>
   
    <div class="row py-5">
        <div class="col-md-8 mx-auto">
            <div class="card p-4">
                <div class="image mx-auto">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="200px">
                </div>
                <h4 class="mx-auto mt-4">Pendaftaran Bimbingan Skripsi</h4>
                <p class="text-justify m-3">Pastikan kebenaran data diri Anda, kemudian masukan <span class="fw-bold">no pembayaran, syarat-syarat dan dokumen pendaftaran</span>, </p>

                <div class="card-body">

                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if(Session::has('update'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('update') }}, pilih <span class="fw-bold">update pendaftaran</span> untuk mengubah data pendaftaran <br>
                            <a href="{{route('bimbinganskripsi.edit', old('nim'))}}" class="btn btn-primary">Update pendaftaran</a>
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

                    <form action="{{route('bimbinganskripsi.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                        <input type="hidden" name="nama" value="{{ $mahasiswa['nama'] }}">
                        <input type="hidden" name="prodi" value="{{ $mahasiswa['prodi'] }}">
                        <div class="mb-3">
                            <label for="no_pembayaran" class="form-label">No Pembayaran</label>
                            <input type="text" name="no_pembayaran" class="form-control @error('no_pembayaran') is-invalid @enderror" id="no_pembayaran" placeholder="SKP-10.10.001" value="{{ old('no_pembayaran') }}">
                            @error('no_pembayaran')
                            <div id="no_pembayaran" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: nama@gmail.com " value="{{ old('email') }}">
                            @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_whatsapp" class="form-label">No Telephone (WA)</label>
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
                            <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi"
                                   class="form-control @error('judul_skripsi') is-invalid @enderror" id="judul_skripsi"
                                   placeholder="ex: judul skripsi" value="{{ old('judul_skripsi') }}">
                            @error('judul_skripsi')
                            <div id="judul_skripsi" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                            <select class="form-select" name="pembimbing1" id="pembimbing1">
                                <option selected>pilih pembimbing</option>
                                @foreach ($dosen as $data)
                                    <option value="{{$data['nama']}}">{{$data['nama']}}</option>
                                @endforeach
                            </select>
                            @error('pembimbing1')
                            <div id="pembimbing1" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                            <select class="form-select" name="pembimbing2" id="pembimbing2">
                                <option selected>pilih pembimbing</option>
                                @foreach ($dosen as $data)
                                    <option value="{{$data['nama']}}">{{$data['nama']}}</option>
                                @endforeach
                            </select>
                            @error('pembimbing2')
                            <div id="pembimbing2" class="invalid-feedback">
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
@endsection
