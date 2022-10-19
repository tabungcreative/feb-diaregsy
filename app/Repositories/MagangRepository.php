<?php

namespace App\Repositories;

use App\Models\Magang;

interface MagangRepository
{
    function getALl();
    function findById($id);
    function create(array $detailMagang, $tahunAjaranId): Magang;
    function findByNim($nim): ?Magang;
    function update(int $id, array $detailMagang): Magang;
}
