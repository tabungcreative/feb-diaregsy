<?php

namespace App\Repositories;

use App\Models\Yudisium;

interface YudisiumRepository
{
    function getALl();
    function findById($id);
    function create(array $detailYudisium, $tahunAjaranId): Yudisium;
    function findByNim($nim): ?Yudisium;
    function update(int $id, array $detailYudisium): Yudisium;
}
