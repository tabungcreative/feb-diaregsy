<?php

namespace App\Repositories;

use App\Models\Sempro;

interface SemproRepository
{
    function getALl();
    function findById($id);
    function create(array $detailMagang, $tahunAjaranId): Sempro;
    function findByNim($nim): ?Sempro;
    function update(int $id, array $detailMagang): Sempro;
    function delete($id);
}
