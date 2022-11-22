<?php

namespace App\Services\Impl;

use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\UjianAkhirIsExistException;
use App\Http\Requests\UjianAkhirCreateMessageRequest;
use App\Http\Requests\UjianAkhirRegisterRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Models\UjianAkhir;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\PembayaranService;
use App\Services\UjianAkhirService;
use App\Traits\MediaTrait;

class UjianAkhirServiceImpl implements UjianAkhirService
{
    use MediaTrait;


    private UjianAkhirRepository $ujianAkhirRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private PembayaranService $pembayaranService;

    public function __construct(
        UjianAkhirRepository $ujianAkhirRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->ujianAkhirRepository = $ujianAkhirRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }


    function register(UjianAkhirRegisterRequest $request)
    {

        // get tahun ajaran aktif
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();

        if ($tahunAjaran == null) {
            throw new TahunAjaranIsNotFound('tahun ajaran belum ditentukan');
        }

        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $prodi = $request->input('prodi');
        $noWhatsapp = $request->input('no_whatsapp');
        $tempatLahir = $request->input('tempat_lahir');
        $tanggalLahir = $request->input('tanggal_lahir');
        $nik = $request->input('nik');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $judulSkripsi = $request->input('judul_skripsi');

        // cek pembayaran
        // $this->pembayaranService->checkPembayaran($noPembayaran, $nim);

        $detailUjianAkhir = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'no_whatsapp' => $noWhatsapp,
            'tempat_lahir' => $tempatLahir,
            'tanggal_lahir' => $tanggalLahir,
            'nik' => $nik,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'judul_skripsi' => $judulSkripsi,
        ];

        // cek apakah sudah pernah mendaftar spl
        $ujianAkhir = $this->ujianAkhirRepository->findByNim($nim);

        if ($ujianAkhir != null) {
            throw new UjianAkhirIsExistException('anda sudah pernah mendaftar ujian akhir');
        }

        $ujianAkhir = $this->ujianAkhirRepository->create($detailUjianAkhir, $tahunAjaran->id);

        return $ujianAkhir;
    }

    function addBerkasSkripsi(int $id, $fileSkripsi)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileSkripsi, 'diaregsi/ujianAkhir/file-skripsi/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->berkas_skripsi = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addIjazahTerakhir(int $id, $fileIjazahTerakhir)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileIjazahTerakhir, 'diaregsi/ujianAkhir/ijazah-terakhir/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->ijazah_terakhir = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addTranskripNilai(int $id, $fileTranskripNilai)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileTranskripNilai, 'diaregsi/ujianAkhir/transkrip-nilai/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->transkrip_nilai = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }
    function addAkta(int $id, $fileAkta)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileAkta, 'diaregsi/ujianAkhir/akta-kelahiran/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->akta_kelahiran = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }
    function addKK(int $id, $fileKK)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileKK, 'diaregsi/ujianAkhir/kartu-keluarga/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->kartu_keluarga = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addKtp(int $id, $fileKtp)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileKtp, 'diaregsi/ujianAkhir/foto-ktp/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->foto_ktp = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addLembarBimbingan(int $id, $fileLembarBimbingan)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileLembarBimbingan, 'diaregsi/ujianAkhir/lembar-bimbingan/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->lembar_bimbingan = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addSlipSemesterTerakhir(int $id, $fileSlipSemesterTerakhir)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileSlipSemesterTerakhir, 'diaregsi/ujianAkhir/slip-semester-terakhir/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->slip_pembayaransemesterterakhir = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addPembayaranSkripsi(int $id, $filePembayaranSkripsi)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($filePembayaranSkripsi, 'diaregsi/ujianAkhir/slip-pembayaran-skripsi/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->slip_pembayaranSkripsi = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addSertifikat(int $id, $fileSertifikat)
    {
        $ujianAkhir = UjianAkhir::find($id);

        $dataFile = $this->uploads($fileSertifikat, 'diaregsi/ujianAkhir/sertifikat/');

        $filePath = $dataFile['filePath'];

        $ujianAkhir->sertifikat = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function verify(int $id)
    {
        $detailUjianAkhir = [
            'is_verify' => 1
        ];
        $ujianAkhir = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);
        return $ujianAkhir;
    }

    function createMessage(int $id, UjianAkhirCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailUjianAkhir = [
            'keterangan' => $pesan,
        ];

        $ujianAkhir = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);
        return $ujianAkhir;
    }

    function update(int $id, UjianAkhirUpdateRequest $request)
    {
        $noWhatsapp = $request->input('no_whatsapp');
        $tempatLahir = $request->input('tempat_lahir');
        $tanggalLahir = $request->input('tanggal_lahir');
        $nik = $request->input('nik');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $judulSkripsi = $request->input('judul_skripsi');

        $detailUjianAkhir = [
            'no_whatsapp' => $noWhatsapp,
            'tempat_lahir' => $tempatLahir,
            'tanggal_lahir' => $tanggalLahir,
            'nik' => $nik,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'judul_skripsi' => $judulSkripsi,
        ];

        $ujianAkhir = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);

        return $ujianAkhir;
    }
}
