<?php

namespace App\Repositories;

use App\Models\BimbinganSkripsi;

interface BimbinganSkripsiRepository
{
    function getALl();
    function findById($id);
    function create(array $detailMagang, $tahunAjaranId): BimbinganSkripsi;
    function findByNim($nim): ?BimbinganSkripsi;
    function update(int $id, array $detailBimbinganSkripsi): BimbinganSkripsi;
}
