<?php

namespace App\Services\Impl;

use App\Exceptions\MahasiswaNotFoundException;
use App\Repositories\MahasiswaRepository;
use App\Services\MahasiswaService;

class MahasiswaServiceImpl implements MahasiswaService
{
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    function checkMahasiswa($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        if ($mahasiswa == null) {
            throw new MahasiswaNotFoundException('mahasiswa tidak ditemukan');
        }
    }
}
