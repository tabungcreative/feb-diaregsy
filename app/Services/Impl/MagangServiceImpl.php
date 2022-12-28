<?php

namespace App\Services\Impl;

use App\Exceptions\MagangIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MagangCreateMessageRequest;
use App\Http\Requests\MagangRegisterRequest;
use App\Http\Requests\MagangUpdateRequest;
use App\Repositories\MagangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\MagangService;
use App\Services\PembayaranService;
use App\Traits\MediaTrait;

class MagangServiceImpl implements MagangService
{
    use MediaTrait;

    private MagangRepository $magangRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private PembayaranService $pembayaranService;

    public function __construct(
        MagangRepository $magangRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->magangRepository = $magangRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }

    function register(MagangRegisterRequest $request)
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
        $alamat = $request->input('alamat');
        $email = $request->input('email');
        $noPembayaran = $request->input('no_pembayaran');
        $instansiMagang = $request->input('instansi_magang');
        $pimpinanInstansi = $request->input('pimpinan_instansi');
        $noWhatsapp = $request->input('no_whatsapp');

        // cek pembayaran
        $kodePembayaran = env('KODE_MAGANG');
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim, $kodePembayaran);

        $detailMagang = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'alamat' => $alamat,
            'email' => $email,
            'no_pembayaran' => $noPembayaran,
            'instansi_magang' => $instansiMagang,
            'pimpinan_instansi' => $pimpinanInstansi,
            'no_whatsapp' => $noWhatsapp,
        ];

        // cek apakah sudah pernah mendaftar magang
        $magang = $this->magangRepository->findByNim($nim);

        if ($magang != null) {
            throw new MagangIsExistException('anda sudah pernah mendaftar magang');
        }

        $magang = $this->magangRepository->create($detailMagang, $tahunAjaran->id);

        return $magang;
    }

    function addLembarPersetujuan(int $id, $fileLembarPersetujuan)
    {
        $dataFile = $this->uploads($fileLembarPersetujuan, 'diaregsi/magang/lembar-persetujuan/');

        $filePath = $dataFile;

        $detailMagang = [
            'lembar_persetujuan' => $filePath
        ];

        $magang = $this->magangRepository->update($id, $detailMagang);

        return $magang;
    }


    function verify(int $id)
    {
        $detailMagang = [
            'is_verify' => 1
        ];
        $magang = $this->magangRepository->update($id, $detailMagang);
        return $magang;
    }


    function createMessage(int $id, MagangCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailMagang = [
            'keterangan' => $pesan,
        ];

        $magang = $this->magangRepository->update($id, $detailMagang);
        return $magang;
    }

    function update(int $id, MagangUpdateRequest $request)
    {
        $alamat = $request->input('alamat');
        $email = $request->input('email');
        $instansiMagang = $request->input('instansi_magang');
        $pimpinanInstansi = $request->input('pimpinan_instansi');
        $noWhatsapp = $request->input('no_whatsapp');

        $detailMagang = [
            'alamat' => $alamat,
            'email' => $email,
            'instansi_magang' => $instansiMagang,
            'pimpinan_instansi' => $pimpinanInstansi,
            'no_whatsapp' => $noWhatsapp,
        ];

        $magang = $this->magangRepository->update($id, $detailMagang);
        return $magang;
    }
}
