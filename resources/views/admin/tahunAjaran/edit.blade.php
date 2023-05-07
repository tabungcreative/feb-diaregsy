@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.tahunAjaran.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Studi Ekskursi</h3>
                    <form action="{{ route('admin.tahunAjaran.update', $tahunAjaran->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="tahun" class="form-label fw-bolder">No Telephone (WA)</label>
                                <input type="number" name="tahun"
                                    class="form-control @error('tahun') is-invalid @enderror" id="tahun"
                                    placeholder="ex: 085xx" value="{{ $tahunAjaran->tahun }}">
                                @error('tahun')
                                <div id="tahun" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label fw-bolder">Jenis Pendaftaran</label>
                                <select class="form-control" id="semester" name="semester" required="required">
                                    <option value="">Semester</option>
                                    <option value="1" @if($tahunAjaran->semester == '1') selected @endif>1 / Ganjil</option>
                                    <option value="2" @if($tahunAjaran->semester == '2') selected @endif>2 / Genap </option>
                                </select>
                                @error('semester')
                                <div id="semester" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
