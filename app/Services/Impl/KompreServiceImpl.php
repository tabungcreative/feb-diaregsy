<?php

namespace App\Services\Impl;

use App\Exceptions\KompreIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\KompreCreateMessageRequest;
use App\Http\Requests\KompreRegisterRequest;
use App\Http\Requests\KompreUpdateRequest;
use App\Repositories\KompreRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\KompreService;
use App\Traits\MediaTrait;


class KompreServiceImpl implements KompreService
{
    use MediaTrait;

    private KompreRepository $kompreRepository;
    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(
        KompreRepository $kompreRepository,
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->kompreRepository = $kompreRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }


    function register(KompreRegisterRequest $request)
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
        $noWhatsapp = $request->input('no_whatsapp');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');

        $detailKompre = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'email' => $email,
            'no_whatsapp' => $noWhatsapp,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
        ];

        // cek apakah sudah pernah mendaftar kompre
        $kompre = $this->kompreRepository->findByNim($nim);

        if ($kompre != null) {
            throw new KompreIsExistException('anda sudah pernah mendaftar kompre');
        }

        $kompre = $this->kompreRepository->create($detailKompre, $tahunAjaran->id);

        return $kompre;
    }

    function addBuktiPembayaran(int $id, $fileBuktiPembayaran)
    {
        $kompre = $this->kompreRepository->findById($id);

        if ($kompre->bukti_pembayaran != null) {
            $this->delete($kompre->bukti_pembayaran);
        }

        $filePath = $this->uploads($fileBuktiPembayaran, 'ujian-komprehensif/bukti-pembayaran/');


        $kompre->bukti_pembayaran = $filePath;
        $kompre->save();

        return $kompre;
    }

    function verify(int $id)
    {
        $detailKompre = [
            'is_verify' => 1
        ];
        $kompre = $this->kompreRepository->update($id, $detailKompre);
        return $kompre;
    }

    function createMessage(int $id, KompreCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailKompre = [
            'keterangan' => $pesan,
        ];

        $kompre = $this->kompreRepository->update($id, $detailKompre);
        return $kompre;
    }

    function update(int $id, KompreUpdateRequest $request)
    {
        $email = $request->input('email');
        $noWhatsapp = $request->input('no_whatsapp');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');

        $detailKompre = [
            'email' => $email,
            'no_whatsapp' => $noWhatsapp,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
        ];

        $kompre = $this->kompreRepository->update($id, $detailKompre);

        return $kompre;
    }

    function destroy($id)
    {
        $kompre = $this->kompreRepository->findById($id);

        $this->deleteFileExist($kompre);

        $this->kompreRepository->delete($id);
    }

    private function deleteFileExist($kompre){
        if ($kompre->bukti_pembayaran != null) {
            $this->delete($kompre->bukti_pembayaran);
        }
    }
}
