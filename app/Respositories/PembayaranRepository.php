<?php

namespace App\Respositories;

interface PembayaranRepository
{
    function findByNoPembayaran(string $noPembayaran);
}
