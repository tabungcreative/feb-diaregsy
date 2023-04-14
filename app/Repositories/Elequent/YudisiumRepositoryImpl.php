<?php

namespace App\Repositories\Elequent;

use App\Models\Yudisium;
use App\Models\TahunAjaran;
use App\Repositories\YudisiumRepository;

class YudisiumRepositoryImpl implements YudisiumRepository
{
    function getALl()
    {
        return Yudisium::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailYudisium, $tahunAjaranId): Yudisium
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $yudisium = new Yudisium($detailYudisium);
        $tahunAjaran->yudisium()->save($yudisium);
        return $yudisium;
    }

    function findById($id)
    {
        return Yudisium::find($id);
    }

    function findByNim($nim): ?Yudisium
    {
        return Yudisium::where('nim', $nim)->first();
    }

    function update(int $id, array $detailYudisium): Yudisium
    {
        $yudisium = Yudisium::find($id);
        $yudisium->update($detailYudisium);
        $yudisium->save();
        return $yudisium;
    }

    function delete($id)
    {
        return Yudisium::where('id', $id)->delete();
    }
}
