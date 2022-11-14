<?php

namespace App\Repositories;

use App\Models\Mengulang;

interface MengulangRepository
{
    function getALl();
    function findById($id);
    function create(array $detailMengulang, $tahunAjaranId): Mengulang;
    function findByNim($nim): ?Mengulang;
    function update(int $id, array $detailMengulang): Mengulang;
}