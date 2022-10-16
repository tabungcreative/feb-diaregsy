@extends("layouts.app")

@section("content")
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-primary mt-5" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row mt-5">
            <h3>List Pendaftaran Mahasiswa</h3>
        </div>
        <div class="row d-flex justify-content-start">
            @php
                $pendaftaran = [
                    ['nama' => 'SPL', 'gambar' => 'test.jpg', 'route' => 'spl.form-register'],
                ]    
            @endphp
            @foreach($pendaftaran as $value)
                <div class="card border-0 my-4 shadow me-4" style="width: 18rem">
                    <a href="{{ route($value['route'], $nim) }}" class="nav-link">
                        <div class="card-gambar">
                            <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="..." />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title pt-3">
                                Pendaftaran {{ $value['nama'] }}
                            </h5>
                            <a href="{{ route($value['route'], $nim) }}" class="btn btn-sm btn-outline-danger">Daftar</a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
