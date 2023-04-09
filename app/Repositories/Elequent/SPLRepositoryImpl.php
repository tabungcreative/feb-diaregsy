<?php

namespace App\Repositories\Elequent;

use App\Models\SPL;
use App\Models\TahunAjaran;
use App\Repositories\SPLRepository;

class SPLRepositoryImpl implements SPLRepository
{
    function getALl()
    {
        return SPL::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailSPL, $tahunAjaranId): SPL
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $spl = new SPL($detailSPL);
        $tahunAjaran->spl()->save($spl);
        return $spl;
    }

    function findById($id)
    {
        return SPL::find($id);
    }

    function findByNim($nim): ?SPL
    {
        return SPL::where('nim', $nim)->first();
    }

    function update(int $id, array $detailSPL): SPL
    {
        $spl = SPL::find($id);
        $spl->update($detailSPL);
        $spl->save();
        return $spl;
    }
    function delete($id)
    {
        return SPL::where('id', $id)->delete();
    }
}
