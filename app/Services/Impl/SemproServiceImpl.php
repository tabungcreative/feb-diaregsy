<?php

namespace App\Services\Impl;

use App\Exceptions\SemproIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Repositories\SemproRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\PembayaranService;
use App\Services\SemproService;
use App\Traits\MediaTrait;

class SemproServiceImpl implements SemproService
{

    use MediaTrait;

    private SemproRepository $semproRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private PembayaranService $pembayaranService;

    public function __construct(
        SemproRepository $semproRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->semproRepository = $semproRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }
    function register(SemproRegisterRequest $request)
    {
        // get tahun ajaran aktif
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();

        if ($tahunAjaran == null) {
            throw new TahunAjaranIsNotFound('tahun ajaran belum ditentukan');
        }

        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $prodi = $request->input('prodi');
        $noPembayaran = $request->input('no_pembayaran');
        $noHp = $request->input('no_hp');
        $judul = $request->input('judul');
        $email = $request->input('email');

        // cek pembayaran
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim);

        $detailSempro = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'no_pembayaran' => $noPembayaran,
            'no_hp' => $noHp,
            'judul' => $judul,
            'email' => $email,
        ];

        // cek apakah sudah pernah mendaftar spl
        $sempro = $this->semproRepository->findByNim($nim);

        if ($sempro != null) {
            throw new SemproIsExistsException('anda sudah pernah mendaftar Seminar Proposal');
        }

        $sempro = $this->semproRepository->create($detailSempro, $tahunAjaran->id);

        return $sempro;
    }

    function addKtp(int $id, $fileKtp)
    {
        // TODO: Implement addKtp() method.
    }

    function verify(int $id)
    {
        $detailSempro = [
            'is_verify' => 1
        ];
        $spl = $this->semproRepository->update($id, $detailSempro);
        return $spl;
    }

    function createMessage(int $id, SemproCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailSempro = [
            'keterangan' => $pesan,
        ];

        $spl = $this->semproRepository->update($id, $detailSempro);
        return $spl;
    }

    function update(int $id, SemproUpdateRequest $request)
    {
        // TODO: Implement update() method.
    }
}
