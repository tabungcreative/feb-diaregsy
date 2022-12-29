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
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBuktiPembayaran, 'diaregsi/yudisium/bukti-pembayaran/');

        $filePath = $dataFile;

        $yudisium->bukti_pembayaran = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasSpp(int $id, $fileBebasSpp)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBebasSpp, 'diaregsi/yudisium/bebas-spp/');

        $filePath = $dataFile;

        $yudisium->bebas_spp = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addTranskripNilai(int $id, $fileTranskripNilai)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileTranskripNilai, 'diaregsi/yudisium/transkrip-nilai/');

        $filePath = $dataFile;

        $yudisium->transkrip_nilai = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasPerpus(int $id, $fileBebasPerpus)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBebasPerpus, 'diaregsi/yudisium/bebas-perpus/');

        $filePath = $dataFile;

        $yudisium->bebas_perpus = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addArtikel(int $id, $fileArtikel)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileArtikel, 'diaregsi/yudisium/artikel/');

        $filePath = $dataFile;

        $yudisium->artikel = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addFileSkripsi(int $id, $fileSkripsi)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileSkripsi, 'diaregsi/yudisium/file-skripsi/');

        $filePath = $dataFile;

        $yudisium->file_skripsi = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBebasPlagiasi(int $id, $fileBebasPlagiasi)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBebasPlagiasi, 'diaregsi/yudisium/bebas-plagiasi/');

        $filePath = $dataFile;

        $yudisium->bebas_plagiasi = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBuktiPenjilidan(int $id, $fileBuktiPenjilidan)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBuktiPenjilidan, 'diaregsi/yudisium/bukti-penjilidan/');

        $filePath = $dataFile;

        $yudisium->bukti_penjilidan = $filePath;
        $yudisium->save();

        return $yudisium;
    }

    function addBuktiPegumpulan(int $id, $fileBuktiPengumpulan)
    {
        $yudisium = Yudisium::find($id);

        $dataFile = $this->uploads($fileBuktiPengumpulan, 'diaregsi/yudisium/bukti-pengumpulan/');

        $filePath = $dataFile;

        $yudisium->bukti_pengumpulan = $filePath;
        $yudisium->save();

        return $yudisium;
    }
}
