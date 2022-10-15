<?php

namespace App\Repositories;

use App\Models\SPL;

interface SPLRepository
{
    function create(array $detailSPL, $tahunAjaranId): SPL;
    function findByNim($nim): ?SPL;
}
