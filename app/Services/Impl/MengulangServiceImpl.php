<?php

namespace App\Services\Impl;

use App\Exceptions\MengulangIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MengulangCreateMessageRequest;
use App\Http\Requests\MengulangRegisterRequest;
use App\Http\Requests\MengulangUpdateRequest;
use App\Repositories\MengulangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\MengulangService;
use App\Services\PembayaranService;
use App\Traits\MediaTrait;

class MengulangServiceImpl implements MengulangService
{
    use MediaTrait;

    private $mengulangRepository;
    private $tahunAjaranRepository;
    private $pembayaranService;


    public function __construct(
        MengulangRepository $mengulangRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->mengulangRepository = $mengulangRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }

    function register(MengulangRegisterRequest $request)
    {
        // get tahun ajaran aktif
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();

        // menampilkan pesan jika tahun ajaran tidak ditemukan
        if ($tahunAjaran == null) {
            throw new TahunAjaranIsNotFound('tahun ajaran belum ditentukan');
        }

        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $prodi = $request->input('prodi');
        $email = $request->input('email');
        $noWhatsapp = $request->input('no_whatsapp');
        $noPembayaran = $request->input('no_pembayaran');

        // cek pembayaran
        $kodePembayaran = env('KODE_MENGULANG');
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim, $kodePembayaran);

        $detailMengulang = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'email' => $email,
            'no_pembayaran' => $noPembayaran,
            'no_whatsapp' => $noWhatsapp,
        ];

        // cek apakah sudah pernah mendaftar magang
        $mengulang = $this->mengulangRepository->findByNim($nim);

        if ($mengulang != null) {
            throw new MengulangIsExistException('anda sudah pernah mendaftar mengulang');
        }

        $mengulang = $this->mengulangRepository->create($detailMengulang, $tahunAjaran->id);

        return $mengulang;
    }

    function addKhs(int $id, $fileKhs)
    {
        $dataFile = $this->uploads($fileKhs, 'diaregsi/mengulang/lhs');

        $filePath = $dataFile;

        $detailMengulang = [
            'khs' => $filePath
        ];

        $mengulang = $this->mengulangRepository->update($id, $detailMengulang);

        return $mengulang;
    }


    function verify(int $id)
    {
        $detailMengulang = [
            'is_verify' => 1
        ];
        $mengulang = $this->mengulangRepository->update($id, $detailMengulang);
        return $mengulang;
    }


    function createMessage(int $id, MengulangCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailMengulang = [
            'keterangan' => $pesan,
        ];

        $mengulang = $this->mengulangRepository->update($id, $detailMengulang);
        return $mengulang;
    }


    function update(int $id, MengulangUpdateRequest $request)
    {
        $email = $request->input('email');
        $noWhatsapp = $request->input('no_whatsapp');

        $detailMengulang = [
            'email' => $email,
            'no_whatsapp' => $noWhatsapp,
        ];

        $mengulang = $this->mengulangRepository->update($id, $detailMengulang);
        return $mengulang;
    }
}
