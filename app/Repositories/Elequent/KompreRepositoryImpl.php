<?php

namespace App\Repositories\Elequent;

use App\Models\Kompre;
use App\Models\TahunAjaran;
use App\Repositories\KompreRepository;

class KompreRepositoryImpl implements KompreRepository
{
    function getALl()
    {
        return Kompre::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailKompre, $tahunAjaranId): Kompre
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $kompre = new Kompre($detailKompre);
        $tahunAjaran->kompre()->save($kompre);
        return $kompre;
    }
    function findById($id)
    {
        return Kompre::find($id);
    }

    function findByNim($nim): ?Kompre
    {
        return Kompre::where('nim', $nim)->first();
    }

    function update(int $id, array $detailKompre): Kompre
    {
        $kompre = Kompre::find($id);
        $kompre->update($detailKompre);
        $kompre->save();
        return $kompre;
    }
}
