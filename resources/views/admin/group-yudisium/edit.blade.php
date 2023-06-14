@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.group-yudisium.index') }}" class="btn btn-primary my-2"> Kembali </a>
    <div class="row mt-3 mb-5">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold">Ubah Data Studi Ekskursi</h3>
                    <form action="{{ route('admin.group-yudisium.update', $groupYudisium->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="link" class="form-label fw-bolder">Nama</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    placeholder="ex: 085xx" value="{{ $groupYudisium->nama }}">
                                @error('nama')
                                <div id="nama" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label fw-bolder">Link</label>
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror" id="link"
                                    placeholder="ex: 085xx" value="{{ $groupYudisium->link }}">
                                @error('link')
                                <div id="link" class="invalid-feedback">
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
