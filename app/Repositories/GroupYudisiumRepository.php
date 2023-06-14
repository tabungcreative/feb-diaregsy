<?php

namespace App\Repositories;

use App\Models\GroupYudisium;

interface GroupYudisiumRepository
{
    function getALl();
    function create(array $detail): GroupYudisium;
    function findByIsActive(): ?GroupYudisium;
    function update(int $id, $detail): GroupYudisium;
    function updateNotActive(): void;
    function updateIsActiveAll($isActive);
    function findById($id);
    function delete($id);
}
