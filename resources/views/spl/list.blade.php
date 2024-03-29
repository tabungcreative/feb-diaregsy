@extends("layouts.app")

@section("content")
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 mx-auto px-0">
                <div class="px-0 py-5 bg-danger text-center text-white ">
                    <h1>Studi Ekskursi</h1>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="col-md-12 mx-auto">
                <div class="card p-4">
                    <div class="image mx-auto">
                        <img src={{asset('/img/logo-feb.png')}} class="img-fluid p-2" alt=" logo-diaregsi" width="100px">
                        <img src={{asset('/img/logo-diaregsy.png')}} class="img-fluid" alt="logo-diaregsi" width="200px">
                    </div>
                    <h4 class="mx-auto mt-4">Mahasiswa Terdaftar Studi Ekskursi (Studi Pengembangan Lapangan) </h4>
                    <div class="card-body">
                        <div class="mb-4">
                            <form method="get" class="input-group mb-3" style="width: 300px">
                                <input type="text" name="key" class="form-control" value="{{ $_GET['key'] ?? '' }}" placeholder="Cari mahasiswa">
                                <button class="btn btn-danger" type="submit" id="button-addon2">Cari</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($spl->count() == 0 )
                                    <td class="p-3" colspan="7">Mahasiswa tidak ditemukan</td>
                                @endif
                                @foreach($spl as $value)
                                    <tr>
                                        <td>{{ $loop->iteration + $spl->firstItem() - 1 }}</td>
                                        <td>{{ $value->nim }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ ucfirst($value->prodi) }}</td>
                                        <td>
                                            {{ $value->tahunAjaran->tahun }}
                                            @if ($value->tahunAjaran->is_active == 1)
                                                (tahun ini)
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->is_verify)
                                                <span class="badge bg-primary">Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning">Berlum Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td style="width: 200px">{{ $value->keterangan ?? '-'}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-3 my-3">
                            {{ $spl->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-5">
        <div class="col-lg-6 md-12 mx-auto">
            <div class="card">
                <div class="image mx-auto mt-5">
                    <img src={{asset('/img/logo-feb.png')}} class="img-fluid" alt=" logo-diaregsi" width="150px">
                </div>
                <div class="card-body text-center">
                    <img src={{asset('/img/alur-akademik/infografis%20feb-02.png')}} class="img-fluid" alt=" logo-diaregsi">
                </div>
            </div>
        </div>
    </div>

@endsection
