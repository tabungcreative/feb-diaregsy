<?php

namespace App\Services\Impl;

use App\Exceptions\BimbinganSkripsiIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\BimbinganSkripsiCreateMessageRequest;
use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Http\Requests\BimbinganSkripsiUpdateRequest;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\BimbinganSkripsiService;
use App\Services\PembayaranService;
use App\Traits\MediaTrait;

class BimbinganSkripsiServiceImpl implements BimbinganSkripsiService
{

    use MediaTrait;

    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private PembayaranService $pembayaranService;

    public function __construct(
        BimbinganSkripsiRepository $bimbinganSkripsiRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }

    function register(BimbinganSkripsiRegisterRequest $request)
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
        $judulSkripsi = $request->input('judul_skripsi');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $noPembayaran = $request->input('no_pembayaran');
        $noWhatsapp = $request->input('no_whatsapp');

        // cek pembayaran
        $kodePembayaran = env('KODE_BIMBINGAN_SKRIPSI');
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim, $kodePembayaran);

        $detailBimbinganSkripsi = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'email' => $email,
            'judul_skripsi' => $judulSkripsi,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'no_pembayaran' => $noPembayaran,
            'no_whatsapp' => $noWhatsapp
        ];

        // cek apakah sudah pernah mendaftar bimbingan skripsi
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findByNim($nim);

        if ($bimbinganSkripsi != null) {
            throw new BimbinganSkripsiIsExistException('anda sudah pernah mendaftar bimbingan skripsi');
        }

        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->create($detailBimbinganSkripsi, $tahunAjaran->id);

        return $bimbinganSkripsi;
    }


    function verify(int $id)
    {
        $detailBimbinganSkripsi = [
            'is_verify' => 1
        ];
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->update($id, $detailBimbinganSkripsi);
        return $bimbinganSkripsi;
    }

    function createMessage(int $id, BimbinganSkripsiCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailBimbinganSkripsi = [
            'keterangan' => $pesan,
        ];

        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->update($id, $detailBimbinganSkripsi);
        return $bimbinganSkripsi;
    }

    function update(int $id, BimbinganSkripsiUpdateRequest $request)
    {
        $email = $request->input('email');
        $judulSkripsi = $request->input('judul_skripsi');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $noWhatsapp = $request->input('no_whatsapp');

        $detailBimbinganSkripsi = [
            'email' => $email,
            'judul_skripsi' => $judulSkripsi,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'no_whatsapp' => $noWhatsapp
        ];

        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->update($id, $detailBimbinganSkripsi);
        return $bimbinganSkripsi;
    }
}
