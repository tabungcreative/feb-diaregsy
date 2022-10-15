<?php

namespace App\Repositories\Elequent;

use App\Models\SPL;
use App\Models\TahunAjaran;
use App\Repositories\SPLRepository;

class SPLRepositoryImpl implements SPLRepository
{
    function create(array $detailSPL, $tahunAjaranId): SPL
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $spl = new SPL($detailSPL);
        $tahunAjaran->spl()->save($spl);
        return $spl;
    }

    function findByNim($nim): ?SPL
    {
        return SPL::where('nim', $nim)->first();
    }
}
