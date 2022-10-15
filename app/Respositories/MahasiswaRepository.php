<?php

namespace App\Respositories;

interface MahasiswaRepository
{
    function findByNim(string $nim);
}
