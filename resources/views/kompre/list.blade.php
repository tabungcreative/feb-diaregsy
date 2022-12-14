@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="py-5 bg-danger text-center text-white">
                <h1>Ujian Komprehensif</h1>
            </div>
        </div>

    </div>
    <div class="row py-5">
        <div class="col-md-12 mx-auto">
            <div class="card p-4">
                <div class="image mx-auto">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-sistem/logo-diaregsy.png" class="img-fluid" alt="logo-diaregsi" width="200px">
                </div>
                <h4 class="mx-auto mt-4">Mahasiswa Terdaftar ujian komprehensif </h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kompre as $value)
                                <tr>
                                    <td>#</td>
                                    <td>{{ $value->nim }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->prodi }}</td>
                                    <td>
                                        @if($value->is_verify)
                                            <span class="badge bg-primary">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-warning">Berlum Terverifikasi</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->keterangan ?? '-'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-5">
        <div class="col-lg-6 md-12 mx-auto">
            <div class="card">
                <div class="image mx-auto mt-5">
                    <img src="https://is3.cloudhost.id/storage-feb/logo-feb.png" class="img-fluid" alt=" logo-diaregsi" width="150px">
                </div>
                <div class="card-body text-center">
                    <img src="https://is3.cloudhost.id/storage-feb/assets/images/alur-akademik/infografis%20feb-06.png" class="img-fluid" alt=" logo-diaregsi">
                </div>
            </div>
        </div>
    </div>

@endsection
