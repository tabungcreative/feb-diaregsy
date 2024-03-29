@extends("layouts.app")

@section("content")
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 mx-auto px-0">
                <div class="py-5 bg-danger text-center text-white">
                    <h1>Seminar Proposal</h1>
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
                    <h4 class="mx-auto mt-4 align-center">
                        Mahasiswa Terdaftar Seminar Proposal
                    </h4>
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
                                    <th>Verifikasi</th>
                                    <th>Status</th>
                                    <th>Jadwal Seminar</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($sempro->count() == 0 )
                                    <td class="p-3" colspan="6">Mahasiswa tidak ditemukan</td>
                                @endif
                                @foreach($sempro as $value)
                                    <tr>
                                        <td>{{ $loop->iteration + $sempro->firstItem() - 1 }}</td>
                                        <td>{{ $value->nim }}</td>
                                        <td>{{ $value->nama }}</td>
                                        <td>{{ ucfirst($value->prodi) }}</td>
                                        <td>
                                            @if($value->is_verify)
                                                <span class="badge text-dark">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            @else
                                                <span class="badge text-dark">Belum Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->status == 'Lulus')
                                                <span class="badge bg-success">{{ $value->status }}</span>
                                            @elseif($value->status == 'Tidak Lulus')
                                                <span class="badge bg-danger">{{ $value->status }}</span>
                                            @elseif($value->status == 'Penjadwalan Seminar')
                                                <span class="badge bg-warning">{{ $value->status }}</span>
                                            @else
                                                <span class="badge bg-dark">{{ $value->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($value->status == 'Lulus' || $value->status == 'Tidak Lulus')
                                                Selesai
                                            @elseif($value->tanggal_seminar == null)
                                                Belum Terjadwal
                                            @else
                                                {{ $value->tanggal_seminar }}
                                            @endif
                                        </td>
                                        <td width="200px">{{ $value->keterangan ?? '-'}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-3 my-3">
                            {{ $sempro->appends($_GET)->links() }}
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
                    <img src={{asset('img/logo-feb.png')}} class="img-fluid" alt=" logo-diaregsi" width="150px">
                </div>
                <div class="card-body text-center">
                    <img src={{asset('img/alur-akademik/infografis%20feb-04.png')}} class="img-fluid" alt=" logo-diaregsi">
                </div>
            </div>
        </div>
    </div>

@endsection
