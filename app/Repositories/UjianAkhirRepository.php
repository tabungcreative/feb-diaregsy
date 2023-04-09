<?php

namespace App\Repositories;

use App\Models\UjianAkhir;

interface UjianAkhirRepository
{
    function getALl();
    function findById($id);
    function create(array $detailUjianAkhir, $tahunAjaranId): UjianAkhir;
    function findByNim($nim): ?UjianAkhir;
    function update(int $id, array $detailUjianAkhir): UjianAkhir;
    function delete($id);
}
