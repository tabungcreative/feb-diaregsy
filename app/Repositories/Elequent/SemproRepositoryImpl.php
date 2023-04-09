<?php

namespace App\Repositories\Elequent;

use App\Models\Sempro;
use App\Models\TahunAjaran;
use App\Repositories\SemproRepository;

class SemproRepositoryImpl implements SemproRepository
{
    function getALl()
    {
        return Sempro::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailSempro, $tahunAjaranId): Sempro
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $sempro = new Sempro($detailSempro);
        $tahunAjaran->sempro()->save($sempro);
        return $sempro;
    }

    function findById($id)
    {
        return Sempro::find($id);
    }

    function findByNim($nim): ?Sempro
    {
        return Sempro::where('nim', $nim)->first();
    }

    function update(int $id, array $detailSempro): Sempro
    {
        $sempro = Sempro::find($id);
        $sempro->update($detailSempro);
        $sempro->save();
        return $sempro;
    }
    function delete($id)
    {
        return Sempro::where('id', $id)->delete();
    }
}
