<?php

namespace App\Repositories\Elequent;

use App\Models\UjianAkhir;
use App\Models\TahunAjaran;
use App\Repositories\UjianAkhirRepository;

class UjianAkhirRepositoryImpl implements UjianAkhirRepository
{
    function getALl()
    {
        return UjianAkhir::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailUjianAkhir, $tahunAjaranId): UjianAkhir
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $ujianAkhir = new UjianAkhir($detailUjianAkhir);
        $tahunAjaran->ujianAkhir()->save($ujianAkhir);
        return $ujianAkhir;
    }

    function findById($id)
    {
        return UjianAkhir::find($id);
    }

    function findByNim($nim): ?UjianAkhir
    {
        return UjianAkhir::where('nim', $nim)->first();
    }

    function update(int $id, array $detailUjianAkhir): UjianAkhir
    {
        $ujianAkhir = UjianAkhir::find($id);
        $ujianAkhir->update($detailUjianAkhir);
        $ujianAkhir->save();
        return $ujianAkhir;
    }
}
