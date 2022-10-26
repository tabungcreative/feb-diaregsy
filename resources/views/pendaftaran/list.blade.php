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
        <div class="row d-flex justify-content-center">
            @php
                $pendaftaran = [
                    ['nama' => 'Studi Ekskursi', 'route' => 'spl.form-register'],
                    ['nama' => 'Magang', 'route' => 'spl.form-register'],
                    ['nama' => 'Seminar Proposal', 'route' => 'sempro.form-register'],
                    ['nama' => 'Komprehensif', 'route' => 'spl.form-register'],
                    ['nama' => 'Bimbingan Skripsi', 'route' => 'spl.form-register'],
                    ['nama' => 'Ujian Skripsi', 'route' => 'spl.form-register'],
                    ['nama' => 'Yudisium', 'route' => 'spl.form-register'],
                    ['nama' => 'Mengulang', 'route' => 'spl.form-register'],
                    ['nama' => 'Semester Pendek', 'route' => 'spl.form-register'],

                ]
            @endphp
            @foreach($pendaftaran as $value)
                <div class="card border-0 my-4 shadow me-4 bg-danger text-white" style="width: 18rem">
                    <a href="{{ route($value['route'], $nim) }}" class="nav-link">
                        <div class="card-body">
                            <h5 class="card-title pt-3">
                                Pendaftaran {{ $value['nama'] }}
                            </h5>
                            <a href="{{ route($value['route'], $nim) }}" class="btn btn-sm btn-outline-light">Daftar</a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
