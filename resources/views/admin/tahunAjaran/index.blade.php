@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <!-- Hoverable Table rows -->
            <div class="card">
                <div class="d-flex align-items-center p-4 flex-row justify-content-between flex-wrap">
                    <div>
                        <h5 class="bg-white flex-grow-1">Daftar Tahun Ajaran Fakultas Ekonomi dan Bisnis</h5>
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
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($tahunAjaran as $value)
                                <tr>
                                    <td>#</td>
                                    <td>{{ $value->tahun }}</td>
                                    <td>{{ $value->semester }}</td>
                                    <td>
                                        @if($value->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-warning">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td class="d-flex ">
                                        <form method="post" action="{{ route('admin.tahunAjaran.active', $value->id) }}" onSubmit="if(!confirm('Yakin ingin aktifkan tahun ajaran ?')){return false;}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mx-1">Aktifkan</button>
                                        </form>
                                        <form method="post" action="{{ route('admin.tahunAjaran.inActive', $value->id) }}" onSubmit="if(!confirm('Yakin ingin non aktifkan tahun ajaran ?')){return false;}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mx-1">Non Aktifkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3 my-3">
                        {{--            {{ $data->links() }}--}}
                    </div>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4>Tambah Tahun Ajaran</h4>
                        <form action="{{ route('admin.tahunAjaran.store') }}" method="POSt">
                            @csrf
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun Ajaran</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="masukkan tahun ajaran">
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" class="form-control" id="semester" name="semester" placeholder="masukkan semester ">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
