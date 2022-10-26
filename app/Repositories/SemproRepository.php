<?php

namespace App\Repositories;

use App\Models\Sempro;

interface SemproRepository
{
    function getALl();
    function findById($id);
    function create(array $detailSempro, $tahunAjaranId): Sempro;
    function findByNim($nim): ?Sempro;
    function update(int $id, array $detailSempro): Sempro;
}
