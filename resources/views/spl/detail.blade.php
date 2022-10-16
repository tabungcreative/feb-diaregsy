@extends("layout.guest")

@section("content")

    <div class="row py-5">
        <div class="col-md-6 mx-auto">
            <div class="card p-2">
                <img src="{{ asset('asset/img/logo-unsiq.png') }}"  class="img-fluid mx-auto" width="200px" alt="" sizes="" srcset="">
                <h3 class="mx-auto mt-4">Registrasi Akun SIKAPTA</h3>
                <p class="text-justify m-3">Pastikan kebenaran data diri Anda, kemudian masukan <b>Email aktif</b> dan tentukan password akun anda, Setelah registrasi anda akan menerima email konfirmasi untuk pengaktifan akun. Periksa email konfirmasi di inbox atau span </p>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="inputEmail4">NIM</label>
                                    <p class="fw-bold"> {{ $mahasiswa->nim }} </p>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">Nama</label>
                                    <p class="fw-bold"> {{ $mahasiswa->nama }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="inputEmail4">Prodi</label>
                                    <p class="fw-bold"> {{ $mahasiswa->prodi }} </p>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">Nomer Telephone</label>
                                    <p class="fw-bold">{{ $mahasiswa->nomer_telp }} </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form action="" method="POST">

                        @Csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror" id="username"
                                   placeholder="Username" value="{{ old('username') }}">
                            @error('username')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email"
                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                   placeholder="ex: mail@mail.id" value="{{ old('email') }}">
                            @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror" id="password"
                                   placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                            <div id="password" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password2" class="form-label">Konirmasi Password</label>
                            <input type="password" name="password2"
                                   class="form-control @error('password2') is-invalid @enderror" id="password2"
                                   placeholder="Konfirmasi Password" value="{{ old('password2') }}">
                            @error('password2')
                            <div id="password" class="invalid-feedback">
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
