<?php

namespace App\Repositories;

use App\Models\Kompre;

interface KompreRepository
{
    function getALl();
    function findById($id);
    function create(array $detailKompre, $tahunAjaranId): Kompre;
    function findByNim($nim): ?Kompre;
    function update(int $id, array $detailKompre): Kompre;
    function delete($id);
}
