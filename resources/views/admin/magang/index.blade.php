@extends('layouts.admin')

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="d-flex align-items-center p-5 flex-row justify-content-between flex-wrap">
            <div>
                <h5 class="bg-white flex-grow-1">Daftar Pendaftaran Kerja Praktek Tahun
                    @if($tahunAjaran)
                        {{$tahunAjaran->tahun}}
                    @else

                    @endif
                </h5>
                <a href="{{ route('admin.magang.export') }}" class="btn btn-success">
                    <i class="fas fa-download"></i>
                    Export Excel
                </a>
            </div>
            <form method="get" class="form-inline my-2 my-lg-0">
                <input type="text" name="key" class="form-control mr-sm-2" value="{{ $_GET['key'] ?? '' }}" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Verifikasi</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($magang as $value)
                        <tr>
                            <td>{{ $loop->iteration + $magang->firstItem() - 1}}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ ucwords($value->prodi) }}</td>
                            @if ($value->tanggal_mulai !== null)
                            <td>{{ Carbon\Carbon::parse($magang['tanggal_mulai'])->translatedFormat('d F Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($magang['tanggal_mulai'])->addMonth(2)->translatedFormat('d F Y') }}</td>
                            @else
                            <td>
                                <span class="badge badge-warning">Belum Ditetapkan</span>
                            </td>
                            <td>
                                <span class="badge badge-warning">Belum Ditetapkan</span>
                            </td>
                            @endif
                            <td>
                                @if($value->is_verify)
                                    <span class="badge badge-success">Terverifikasi</span>
                                @else
                                    <span class="badge badge-dark">Belum Terverifikasi</span>
                                @endif
                            </td>
                            <td class="d-flex ">
                                <form method="post" action="{{ route('admin.magang.verify', $value->id) }}" onSubmit="if(!confirm('Yakin ingin verifikasi pendaftaran ?')){return false;}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mx-1">Verifikasi</button>
                                </form>
                                <a href="{{ route('admin.magang.edit', $value->nim) }}" class="btn btn-sm btn-primary mx-1">Edit</a>
                                <form method="post" action="{{ route('admin.magang.delete', $value->id ) }}" onsubmit="return confirm('Konfirmasi Hapus Data . !!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mx-1">Hapus</button>
                                </form>
                                <a href="{{ route('admin.magang.detail', $value->id) }}" class="btn btn-sm btn-info mx-1">Detail</a>
                                <a href="{{ route('admin.magang.print', $value->id) }}" class="btn btn-sm btn-warning @if($value->tanggal_mulai == null || !$value->is_verify) disabled @endif" target="_blank" >Cetak</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-3 my-3">
                {{ $magang->appends($_GET)->links() }}
            </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
