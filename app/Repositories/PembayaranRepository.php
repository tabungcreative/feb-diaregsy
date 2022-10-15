<?php

namespace App\Repositories;

interface PembayaranRepository
{
    function findByNoPembayaran(string $noPembayaran);
}
