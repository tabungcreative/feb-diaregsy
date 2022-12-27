<?php

namespace App\Services\Impl;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Repositories\MahasiswaRepository;
use App\Repositories\PembayaranRepository;
use App\Services\PembayaranService;

class PembayaranServiceImpl implements PembayaranService
{
    private PembayaranRepository $pembayaranRepository;
    private MahasiswaRepository $mahasiswaRepository;


    public function __construct(
        PembayaranRepository $pembayaranRepository,
        MahasiswaRepository $mahasiswaRepository
    ) {
        $this->pembayaranRepository = $pembayaranRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }
    function checkPembayaran($noPembayaran, $nim, $kodePembayaran = null)
    {
        $pembayaran = $this->pembayaranRepository->findByNoPembayaran($noPembayaran);
        if ($pembayaran == null) {
            throw new PembayaranNotFoundException('pembayaran tidak ditemukan');
        }

        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        if ($mahasiswa == null) {
            throw new MahasiswaNotFoundException('mahasiswa tidak ditemukan');
        }

        if ($mahasiswa['nim'] != $pembayaran['nim']) {
            throw new PembayaranNotSuitableWithNimException('Nim dan Nomer Pembayaran tidak sesuai');
        }

        if ($kodePembayaran != $pembayaran['kode_pembayaran']) {
            throw new PembayaranNotSuitableWithNimException('Pembayaran tidak sesuai');
        }

        return true;
    }
}
