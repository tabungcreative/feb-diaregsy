<?php

namespace App\Repositories;

use App\Models\TahunAjaran;

interface TahunAjaranRepository
{
    function create(array $detailTahunAjaran): TahunAjaran;
    function findByIsActive(): ?TahunAjaran;
    function update(int $id, $detailTahunAjaran): TahunAjaran;
    function updateNotActive(): void;
}
