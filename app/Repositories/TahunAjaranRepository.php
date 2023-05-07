<?php

namespace App\Repositories;

use App\Models\TahunAjaran;

interface TahunAjaranRepository
{
    function getALl();
    function create(array $detailTahunAjaran): TahunAjaran;
    function findByIsActive(): ?TahunAjaran;
    function update(int $id, $detailTahunAjaran): TahunAjaran;
    function updateNotActive(): void;
    function updateIsActiveAll($isActive);
    function findById($id);
    function delete($id);
}
