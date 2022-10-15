<?php

namespace App\Services\Impl;

use App\Exceptions\PembayaranNotFoundException;
use App\Respositories\PembayaranRepository;
use App\Services\PembayaranService;

class PembayaranServiceImpl implements PembayaranService
{
    private PembayaranRepository $pembayaranRepository;

    public function __construct(PembayaranRepository $pembayaranRepository)
    {
        $this->pembayaranRepository = $pembayaranRepository;
    }
    function checkPembayaran($noPembayaran)
    {
        $pembayaran = $this->pembayaranRepository->findByNoPembayaran($noPembayaran);

        if ($pembayaran == null) {
            throw new PembayaranNotFoundException('pembayaran tidak ditemukan');
        }

        return true;
    }
}
