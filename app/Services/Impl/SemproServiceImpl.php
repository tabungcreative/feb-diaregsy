<?php

namespace App\Services\Impl;

use App\Exceptions\SemproIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Models\Sempro;
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
        $email = $request->input('email');
        $judulSempro = $request->input('judul_sempro');
        $noWhatsapp = $request->input('no_whatsapp');
        $noPembayaran = $request->input('no_pembayaran');

        // cek pembayaran
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim);

        $detailSempro = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'email' => $email,
            'judul_sempro' => $judulSempro,
            'no_whatsapp' => $noWhatsapp,
            'no_pembayaran' => $noPembayaran,
            'nota_kaprodi' => null,
            'berkas_sempro' => null,
        ];

        // cek apakah sudah pernah mendaftar sempro
        $sempro = $this->semproRepository->findByNim($nim);

        if ($sempro != null) {
            throw new SemproIsExistException('anda sudah pernah mendaftar sempro');
        }

        $sempro = $this->semproRepository->create($detailSempro, $tahunAjaran->id);

        return $sempro;
    }

    function addNotaKaprodi(int $id, $fileNotaKaprodi)
    {
        $sempro = Sempro::find($id);

        $dataFile = $this->uploads($fileNotaKaprodi, 'diaregsi/sempro/nota-kaprodi/');

        $filePath = $dataFile['filePath'];

        $sempro->nota_kaprodi = $filePath;
        $sempro->save();

        return $sempro;
    }

    function addBerkasSempro(int $id, $fileBerkasSempro)
    {
        $sempro = Sempro::find($id);

        $dataFile = $this->uploads($fileBerkasSempro, 'diaregsi/sempro/berkas-sempro/');

        $filePath = $dataFile['filePath'];

        $sempro->berkas_sempro = $filePath;
        $sempro->save();

        return $sempro;
    }

    function verify(int $id)
    {
        $detailSempro = [
            'is_verify' => 1
        ];
        $sempro = $this->semproRepository->update($id, $detailSempro);
        return $sempro;
    }

    function createMessage(int $id, SemproCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailSempro = [
            'keterangan' => $pesan,
        ];

        $sempro = $this->semproRepository->update($id, $detailSempro);
        return $sempro;
    }

    function update(int $id, SemproUpdateRequest $request)
    {
        $email = $request->input('email');
        $judulSempro = $request->input('judul_sempro');
        $noWhatsapp = $request->input('no_whatsapp');

        $detailSempro = [
            'email' => $email,
            'judul_sempro' => $judulSempro,
            'no_whatsapp' => $noWhatsapp,
        ];

        $sempro = $this->semproRepository->update($id, $detailSempro);

        return $sempro;
    }
}
