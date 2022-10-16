<?php

namespace App\Repositories;

use App\Models\SPL;

interface SPLRepository
{
    function getALl();
    function findById($id);
    function create(array $detailSPL, $tahunAjaranId): SPL;
    function findByNim($nim): ?SPL;
    function update(int $id, array $detailSPL): SPL;
}
