<?php

namespace App\Repositories;

interface MahasiswaRepository
{
    function findByNim(string $nim);
}
