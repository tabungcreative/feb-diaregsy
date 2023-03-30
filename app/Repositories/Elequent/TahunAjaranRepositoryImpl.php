<?php

namespace App\Repositories\Elequent;

use App\Models\TahunAjaran;
use App\Repositories\TahunAjaranRepository;
use Illuminate\Support\Facades\DB;

class TahunAjaranRepositoryImpl implements TahunAjaranRepository
{

    function getALl()
    {
        return TahunAjaran::orderBy('created_at', 'DESC')->get();
    }

    function create(array $detailTahunAjaran): TahunAjaran
    {
        $tahunAjaran = new TahunAjaran($detailTahunAjaran);
        $tahunAjaran->save();

        return $tahunAjaran;
    }

    function findByIsActive(): ?TahunAjaran
    {
        return TahunAjaran::where('is_active', 1)->first();
    }

    function update(int $id, $detailTahunAjaran): TahunAjaran
    {
        $tahunAjaran  = TahunAjaran::find($id);
        $tahunAjaran->update($detailTahunAjaran);
        $tahunAjaran->save();
        return $tahunAjaran;
    }

    function updateNotActive(): void
    {
        TahunAjaran::all()->update(['is_active' => 0]);
    }

    function updateIsActiveAll($isActive)
    {
        DB::table('tahun_ajaran')->update(['is_active' => $isActive]);
    }
}
