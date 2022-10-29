<?php

namespace App\Repositories\Elequent;

use App\Models\BimbinganSkripsi;
use App\Models\TahunAjaran;
use App\Repositories\BimbinganSkripsiRepository;

class BimbinganSkripsiRepositoryImpl implements BimbinganSkripsiRepository
{
    function getALl()
    {
        return BimbinganSkripsi::orderBy('created_at', 'DESC')->get();
    }

    function create(array $detailBimbinganSkripsi, $tahunAjaranId): BimbinganSkripsi
    {
        $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        $bimbinganSkripsi = new BimbinganSkripsi($detailBimbinganSkripsi);
        $tahunAjaran->bimbinganSkripsi()->save($bimbinganSkripsi);
        return $bimbinganSkripsi;
    }

    function findById($id)
    {
        return BimbinganSkripsi::find($id);
    }

    function findByNim($nim): ?BimbinganSkripsi
    {
        return BimbinganSkripsi::where('nim', $nim)->first();
    }

    function update(int $id, array $detailBimbinganSkripsi): BimbinganSkripsi
    {
        $bimbinganSkripsi = BimbinganSkripsi::find($id);
        $bimbinganSkripsi->update($detailBimbinganSkripsi);
        $bimbinganSkripsi->save();
        return $bimbinganSkripsi;
    }
}
