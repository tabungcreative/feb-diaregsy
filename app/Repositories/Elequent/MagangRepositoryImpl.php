<?php

namespace App\Repositories\Elequent;

use App\Models\Magang;
use App\Models\TahunAjaran;
use App\Repositories\MagangRepository;

class MagangRepositoryImpl implements MagangRepository
{
    function getALl()
    {
        return Magang::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailMagang, $tahunAjaranId): Magang
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $magang = new Magang($detailMagang);
        $tahunAjaran->magang()->save($magang);
        return $magang;
    }

    function findById($id)
    {
        return Magang::find($id);
    }

    function findByNim($nim): ?Magang
    {
        return Magang::where('nim', $nim)->first();
    }

    function update(int $id, array $detailSPL): Magang
    {
        $spl = Magang::find($id);
        $spl->update($detailSPL);
        $spl->save();
        return $spl;
    }
}
