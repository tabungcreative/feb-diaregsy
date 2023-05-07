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
                    ['nama' => 'Studi Ekskursi', 'route' => 'spl', 'model' => 'SPL'],
                    ['nama' => 'Kerja Praktek', 'route' => 'magang', 'model' => 'Magang'],
                    ['nama' => 'Mengulang', 'route' => 'mengulang', 'model' => 'Mengulang'],
                    ['nama' => 'Seminar Proposal', 'route' => 'sempro', 'model' => 'Sempro'],
                    ['nama' => 'Bimbingan Tugas Akhir', 'route' => 'bimbinganSkripsi', 'model' => 'BimbinganSkripsi'],
                    ['nama' => 'Ujian Komprehensif', 'route' => 'kompre', 'model' => 'Kompre'],
                    ['nama' => 'Ujian Tugas Akhir', 'route' => 'ujianAkhir', 'model' => 'UjianAkhir'],
                    ['nama' => 'Yudisium', 'route' => 'yudisium', 'model' => 'Yudisium'],
                    // ['nama' => 'Semester Pendek', 'route' => 'spl.form-register'],
                ]
            @endphp
            @foreach($pendaftaran as $value)
                <div class="card border-0 my-4 p-4 shadow me-4 bg-danger text-white" style="width: 18rem">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <h5 class="card-title pt-3">
                                Pendaftaran {{ $value['nama'] }}
                            </h5>
                            <div class="b-0">
                                @if (app("App\\Models\\" . $value['model'])::where('nim', $nim)->count() > 0)
                                    <p class="badge bg-light text-dark">Sudah Terdaftar</p>
                                    <a href="{{ route($value['route'] . ".edit", $nim) }}" class="btn btn-sm btn-outline-light">Update Pendaftaran</a>
                                @else
                                    <a href="{{ route($value['route'] . ".form-register", $nim) }}" class="btn btn-sm btn-light">Daftar</a>
                                @endif
                            </div>
                        </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
