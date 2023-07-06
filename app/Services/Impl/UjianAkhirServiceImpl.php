<?php

namespace App\Services\Impl;

use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\UjianAkhirIsExistException;
use App\Http\Requests\UjianAkhirAddTanggalUjianRequest;
use App\Http\Requests\UjianAkhirCreateMessageRequest;
use App\Http\Requests\UjianAkhirRegisterRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Http\Requests\UjianAkhirUpdateStatusRequest;
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
        $email = $request->input('email');
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
            'email' => $email,
            'no_whatsapp' => $noWhatsapp,
            'tempat_lahir' => $tempatLahir,
            'tanggal_lahir' => $tanggalLahir,
            'nik' => $nik,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'judul_skripsi' => $judulSkripsi,
            'status' => 'Proses Pengajuan'
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
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->berkas_skripsi != null) {
            $this->delete($ujianAkhir->berkas_skripsi);
        }

        $filePath = $this->uploads($fileSkripsi, 'ujian-tugas-akhir/file-tugas-akhir/');

        $ujianAkhir->berkas_skripsi = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addIjazahTerakhir(int $id, $fileIjazahTerakhir)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->ijazah_terakhir != null) {
            $this->delete($ujianAkhir->ijazah_terakhir);
        }
        $filePath = $this->uploads($fileIjazahTerakhir, 'ujian-tugas-akhir/ijazah-terakhir/');

        $ujianAkhir->ijazah_terakhir = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addTranskripNilai(int $id, $fileTranskripNilai)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->transkrip_nilai != null) {
            $this->delete($ujianAkhir->transkrip_nilai);
        }

        $filePath = $this->uploads($fileTranskripNilai, 'ujian-tugas-akhir/transkrip-nilai/');

        $ujianAkhir->transkrip_nilai = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }
    function addAkta(int $id, $fileAkta)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->akta_kelahiran != null) {
            $this->delete($ujianAkhir->akta_kelahiran);
        }

        $filePath = $this->uploads($fileAkta, 'ujian-tugas-akhir/akta-kelahiran/');

        $ujianAkhir->akta_kelahiran = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }
    function addKK(int $id, $fileKK)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->kartu_keluarga != null) {
            $this->delete($ujianAkhir->kartu_keluarga);
        }

        $filePath = $this->uploads($fileKK, 'ujian-tugas-akhir/kartu-keluarga/');


        $ujianAkhir->kartu_keluarga = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addKtp(int $id, $fileKtp)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->ktp != null) {
            $this->delete($ujianAkhir->ktp);
        }

        $filePath = $this->uploads($fileKtp, 'ujian-tugas-akhir/foto-ktp/');


        $ujianAkhir->ktp = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addLembarBimbingan(int $id, $fileLembarBimbingan)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->lembar_bimbingan != null) {
            $this->delete($ujianAkhir->lembar_bimbingan);
        }

        $filePath = $this->uploads($fileLembarBimbingan, 'ujian-tugas-akhir/lembar-bimbingan/');


        $ujianAkhir->lembar_bimbingan = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addSlipSemesterTerakhir(int $id, $fileSlipSemesterTerakhir)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->slip_pembayaransemesterterakhir != null) {
            $this->delete($ujianAkhir->slip_pembayaransemesterterakhir);
        }

        $filePath = $this->uploads($fileSlipSemesterTerakhir, 'ujian-tugas-akhir/slip-pembayaran-semester-terakhir/');

        $ujianAkhir->slip_pembayaransemesterterakhir = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addPembayaranSkripsi(int $id, $filePembayaranSkripsi)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->slip_pembayaranSkripsi != null) {
            $this->delete($ujianAkhir->slip_pembayaranSkripsi);
        }

        $filePath = $this->uploads($filePembayaranSkripsi, 'ujian-tugas-akhir/slip-pembayaran-skripsi/');


        $ujianAkhir->slip_pembayaranSkripsi = $filePath;
        $ujianAkhir->save();

        return $ujianAkhir;
    }

    function addSertifikat(int $id, $fileSertifikat)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        if ($ujianAkhir->sertifikat != null) {
            $this->delete($ujianAkhir->sertifikat);
        }

        $filePath = $this->uploads($fileSertifikat, 'ujian-tugas-akhir/sertifikat/');


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

        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        // $this->deleteFileExist($ujianAkhir);

        $ujianAkhir = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);

        return $ujianAkhir;
    }

    function destroy($id)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);

        $this->deleteFileExist($ujianAkhir);

        $this->ujianAkhirRepository->delete($id);
    }

    private function deleteFileExist($ujianAkhir){
        if ($ujianAkhir->berkas_skripsi != null) {
            $this->delete($ujianAkhir->berkas_skripsi);
        }
        if ($ujianAkhir->ijazah_terakhir != null) {
            $this->delete($ujianAkhir->ijazah_terakhir);
        }
        if ($ujianAkhir->transkrip_nilai != null) {
            $this->delete($ujianAkhir->transkrip_nilai);
        }
        if ($ujianAkhir->akta_kelahiran != null) {
            $this->delete($ujianAkhir->akta_kelahiran);
        }
        if ($ujianAkhir->kartu_keluarga != null) {
            $this->delete($ujianAkhir->kartu_keluarga);
        }
        if ($ujianAkhir->ktp != null) {
            $this->delete($ujianAkhir->ktp);
        }
        if ($ujianAkhir->lembar_bimbingan != null) {
            $this->delete($ujianAkhir->lembar_bimbingan);
        }
        if ($ujianAkhir->slip_pembayaransemesterterakhir != null) {
            $this->delete($ujianAkhir->slip_pembayaransemesterterakhir);
        }
        if ($ujianAkhir->slip_pembayaranSkripsi != null) {
            $this->delete($ujianAkhir->slip_pembayaranSkripsi);
        }
        if ($ujianAkhir->sertifikat != null) {
            $this->delete($ujianAkhir->sertifikat);
        }
    }

    public function changeStatus(int $id, UjianAkhirUpdateStatusRequest $request)
    {
        $detailUjianAkhir = [
            'status' => $request->status,
        ];
        $kompre = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);
        return $kompre;
    }

    public function addTanggalUjian($id, UjianAkhirAddTanggalUjianRequest $request)
    {
        $detailUjianAkhir = [
            'tanggal_ujian' => $request->tanggal_ujian,
        ];
        $kompre = $this->ujianAkhirRepository->update($id, $detailUjianAkhir);
        return $kompre;
    }
}
