@extends('layouts.admin')

@section('content')
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="d-flex align-items-center p-5 flex-row justify-content-between flex-wrap">
            <div>
                <h5 class="bg-white flex-grow-1">Daftar Pendaftaran Ujian Komprehensif Tahun
                    @if($tahunAjaran)
                        {{$tahunAjaran->tahun}}
                    @else

                    @endif
                </h5>
                <a href="{{ route('admin.kompre.export') }}" class="btn btn-success">
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
                        <th>Verifikasi</th>
                        <th>Status</th>
                        <th>Tanggal Ujian</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($kompre as $value)
                        <tr>
                            <td>{{ $loop->iteration + $kompre->firstItem() - 1}}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ ucwords($value->prodi) }}</td>
                            <td>
                                @if($value->is_verify)
                                    <span class="badge">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge">Belum Terverifikasi</span>
                                @endif
                            </td>
                            <td>
                                @if($value->status == 'Lulus')
                                    <span class="badge badge-success">{{ $value->status }}</span>
                                @elseif($value->status == 'Tidak Lulus')
                                    <span class="badge badge-danger">{{ $value->status }}</span>
                                @elseif($value->status == 'Penjadwalan Ujian')
                                    <span class="badge badge-warning">{{ $value->status }}</span>
                                @else
                                    <span class="badge badge-dark">{{ $value->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($value->status == 'Lulus' || $value->status == 'Tidak Lulus')
                                    Selesai
                                @elseif($value->tanggal_ujian == null)
                                    Belum Terjadwal
                                @else
                                    {{ $value->tanggal_ujian }}
                                @endif
                            </td>
                            <td class="d-flex ">
                                <form method="post" action="{{ route('admin.kompre.verify', $value->id) }}" onSubmit="if(!confirm('Yakin ingin verifikasi pendaftaran ?')){return false;}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mx-1" @if ($value->is_verify) disabled @endif>Verifikasi</button>
                                </form>
                                <a href="{{ route('admin.kompre.detail', $value->id) }}" class="btn btn-sm btn-info">
                                    Detail
                                </a>
                                <a href="{{ route('admin.kompre.edit', $value->nim) }}" class="btn btn-sm btn-primary mx-1">
                                    Edit
                                </a>
                                <form method="post" action="{{ route('admin.kompre.delete', $value->id ) }}" onsubmit="return confirm('Konfirmasi Hapus Data . !!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-3 my-3">
                {{ $kompre->appends($_GET)->links() }}
            </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
