@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card border-0 mx-auto shadow">
                    <div class="card-header text-center bg-white">
                        <div class="image mx-auto">
                            <img src="{{asset('/img/logo-feb.png')}}" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                            <img src="{{asset('/img/logo-diaregsy.png')}}" class="img-fluid" alt="logo-diaregsi" width="200px">
                        </div>
                        <h3 class="mx-auto mt-4">Cek Mahasiswa Terdaftar</h3>
                    </div>
                    <div class="card-body">
                        <p>Untuk dapat mendaftar pastikan anda terdaftar sebagai mahasiswa FEB , silahkan masukan NIM anda</p>

                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('pendaftaran.cek-nim') }}">

                            @Csrf

                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" name="nim"
                                       class="form-control @error('nim') is-invalid @enderror" id="nim"
                                       placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}">
                                @error('nim')
                                <div id="nama_seminar" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-danger text-white shadow">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
