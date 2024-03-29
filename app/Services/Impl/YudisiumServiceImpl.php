<?php

namespace App\Services\Impl;

use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\YudisiumIsExistException;
use App\Http\Requests\YudisiumCreateMessageRequest;
use App\Http\Requests\YudisiumRegisterRequest;
use App\Http\Requests\YudisiumUpdateRequest;
use App\Models\Yudisium;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\YudisiumRepository;
use App\Services\YudisiumService;
use App\Traits\MediaTrait;

class YudisiumServiceImpl implements YudisiumService
{
    use MediaTrait;

    private YudisiumRepository $yudisiumRepository;
    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(
        YudisiumRepository $yudisiumRepository,
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->yudisiumRepository = $yudisiumRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }

    function register(YudisiumRegisterRequest $request)
    {

        // get tahun ajaran aktif
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();

        if ($tahunAjaran == null) {
            throw new TahunAjaranIsNotFound('tahun ajaran belum ditentukan');
        }

        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $prodi = $request->input('prodi');
        $judulSkripsi = $request->input('judul_skripsi');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalUjian = $request->input('tanggal_ujian');
        $jenisKelamin = $request->input('jenis_kelamin');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $noWhatsapp = $request->input('no_whatsapp');
        $ukuranToga = $request->input('ukuran_toga');

        $detailYudisium = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'judul_skripsi' => $judulSkripsi,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_ujian' => $tanggalUjian,
            'jenis_kelamin' => $jenisKelamin,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'no_whatsapp' => $noWhatsapp,
            'ukuran_toga' => $ukuranToga,
        ];

        // cek apakah sudah pernah mendaftar yudisium
        $yudisium = $this->yudisiumRepository->findByNim($nim);

        if ($yudisium != null) {
            throw new YudisiumIsExistException('anda sudah pernah mendaftar Yudisium');
        }

        $yudisium = $this->yudisiumRepository->create($detailYudisium, $tahunAjaran->id);

        return $yudisium;
    }

    function verify(int $id)
    {
        $detailYudisium = [
            'is_verify' => 1
        ];
        $yudisium = $this->yudisiumRepository->update($id, $detailYudisium);
        return $yudisium;
    }

    function createMessage(int $id, YudisiumCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailYudisium = [
            'keterangan' => $pesan,
        ];

        $yudisium = $this->yudisiumRepository->update($id, $detailYudisium);
        return $yudisium;
    }

    function update(int $id, YudisiumUpdateRequest $request)
    {
        $judulSkripsi = $request->input('judul_skripsi');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalUjian = $request->input('tanggal_ujian');
        $jenisKelamin = $request->input('jenis_kelamin');
        $pembimbing1 = $request->input('pembimbing1');
        $pembimbing2 = $request->input('pembimbing2');
        $noWhatsapp = $request->input('no_whatsapp');
        $ukuranToga = $request->input('ukuran_toga');

        $detailYudisium = [
            'judul_skripsi' => $judulSkripsi,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_ujian' => $tanggalUjian,
            'jenis_kelamin' => $jenisKelamin,
            'pembimbing1' => $pembimbing1,
            'pembimbing2' => $pembimbing2,
            'no_whatsapp' => $noWhatsapp,
            'ukuran_toga' => $ukuranToga,
        ];

        $yudisium = $this->yudisiumRepository->update($id, $detailYudisium);

        return $yudisium;
    }

    function addBuktiPembayaran(int $id, $fileBuktiPembayaran)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bukti_pembayaran != null) {
            $this->delete($yudisium->bukti_pembayaran);
        }
        $filePath = $this->uploads($fileBuktiPembayaran, 'yudisium/bukti-pembayaran/');

        $yudisium->bukti_pembayaran = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasSpp(int $id, $fileBebasSpp)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bebas_spp != null) {
            $this->delete($yudisium->bebas_spp);
        }

        $filePath = $this->uploads($fileBebasSpp, 'yudisium/bebas-spp/');

        $yudisium->bebas_spp = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addTranskripNilai(int $id, $fileTranskripNilai)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->transkrip_nilai != null) {
            $this->delete($yudisium->transkrip_nilai);
        }

        $filePath = $this->uploads($fileTranskripNilai, 'yudisium/transkrip-nilai/');

        $yudisium->transkrip_nilai = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasPerpus(int $id, $fileBebasPerpus)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bebas_perpus != null) {
            $this->delete($yudisium->bebas_perpus);
        }

        $filePath = $this->uploads($fileBebasPerpus, 'yudisium/bebas-perpus/');

        $yudisium->bebas_perpus = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addArtikel(int $id, $fileArtikel)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->artikel != null) {
            $this->delete($yudisium->artikel);
        }

        $filePath = $this->uploads($fileArtikel, 'yudisium/artikel/');


        $yudisium->artikel = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addFileSkripsi(int $id, $fileSkripsi)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->file_skripsi != null) {
            $this->delete($yudisium->file_skripsi);
        }

        $filePath = $this->uploads($fileSkripsi, 'yudisium/file-skripsi/');


        $yudisium->file_skripsi = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasPlagiasi(int $id, $fileBebasPlagiasi)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bebas_plagiasi != null) {
            $this->delete($yudisium->bebas_plagiasi);
        }

        $filePath = $this->uploads($fileBebasPlagiasi, 'yudisium/bebas-plagiasi/');

        $yudisium->bebas_plagiasi = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBuktiPenjilidan(int $id, $fileBuktiPenjilidan)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bukti_penjilidan != null) {
            $this->delete($yudisium->bukti_penjilidan);
        }

        $filePath = $this->uploads($fileBuktiPenjilidan, 'yudisium/bukti-penjilidan/');


        $yudisium->bukti_penjilidan = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBuktiPegumpulan(int $id, $fileBuktiPengumpulan)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        if ($yudisium->bukti_pengumpulan != null) {
            $this->delete($yudisium->bukti_pengumpulan);
        }

        $filePath = $this->uploads($fileBuktiPengumpulan, 'yudisium/bukti-pengumpulan/');

        $yudisium->bukti_pengumpulan = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function destroy($id)
    {
        $yudisium = $this->yudisiumRepository->findById($id);

        $this->deleteFileExist($yudisium);

        $this->yudisiumRepository->delete($id);
    }

    private function deleteFileExist($yudisium){
        if ($yudisium->bukti_pembayaran != null) {
            $this->delete($yudisium->bukti_pembayaran);
        }
        if ($yudisium->bebas_spp != null) {
            $this->delete($yudisium->bebas_spp);
        }
        if ($yudisium->transkrip_nilai != null) {
            $this->delete($yudisium->transkrip_nilai);
        }
        if ($yudisium->bebas_perpus != null) {
            $this->delete($yudisium->bebas_perpus);
        }
        if ($yudisium->artikel != null) {
            $this->delete($yudisium->artikel);
        }
        if ($yudisium->file_skripsi != null) {
            $this->delete($yudisium->file_skripsi);
        }
        if ($yudisium->bebas_plagiasi != null) {
            $this->delete($yudisium->bebas_plagiasi);
        }
        if ($yudisium->bukti_penjilidan != null) {
            $this->delete($yudisium->bukti_penjilidan);
        }
        if ($yudisium->bukti_pengumpulan != null) {
            $this->delete($yudisium->bukti_pengumpulan);
        }
    }
}
