<?php

namespace App\Repositories\Elequent;

use App\Models\Mengulang;
use App\Models\TahunAjaran;
use App\Repositories\MengulangRepository;

class MengulangRepositoryImpl implements MengulangRepository
{
    function getALl()
    {
        return Mengulang::orderBy('created_at', 'DESC')->get();
    }
    function create(array $detailMengulang, $tahunAjaranId): Mengulang
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $mengulang = new Mengulang($detailMengulang);
        $tahunAjaran->mengulang()->save($mengulang);
        return $mengulang;
    }

    function findById($id)
    {
        return Mengulang::find($id);
    }

    function findByNim($nim): ?Mengulang
    {
        return Mengulang::where('nim', $nim)->first();
    }

     function update(int $id, array $detailMengulang): Mengulang
    {
        $mengulang = Mengulang::find($id);
        $mengulang->update($detailMengulang);
        $mengulang->save();
        return $mengulang;
    }

    function delete($id)
    {
        return Mengulang::where('id', $id)->delete();
    }

    function findByNimAndTahunAjaran($nim, $tahunAjaranId)
    {
        return Mengulang::where('nim', $nim)->where('tahun_ajaran_id', $tahunAjaranId)->first();
    }
}
