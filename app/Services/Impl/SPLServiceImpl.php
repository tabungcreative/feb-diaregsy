<?php

namespace App\Services\Impl;

use App\Exceptions\SPLIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SPLCreateMessageRequest;
use App\Http\Requests\SPLRegisterRequest;
use App\Http\Requests\SPLUpdateRequest;
use App\Models\SPL;
use App\Repositories\SPLRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\PembayaranService;
use App\Services\SPLService;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SPLServiceImpl implements SPLService
{
    use MediaTrait;

    private SPLRepository $splRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private PembayaranService $pembayaranService;

    public function __construct(
        SPLRepository $splRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        PembayaranService $pembayaranService
    ) {
        $this->splRepository = $splRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->pembayaranService = $pembayaranService;
    }

    function register(SPLRegisterRequest $request)
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
        $jenisPendaftaran = $request->input('jenis_pendaftaran');

        // cek pembayaran
        // $kodePembayaran = env('KODE_SPL');
        // $this->pembayaranService->checkPembayaran($noPembayaran, $nim, $kodePembayaran);

        $detailSPL = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'jenis_pendaftaran' => $jenisPendaftaran,
            'no_whatsapp' => $noWhatsapp,
        ];

        // cek apakah sudah pernah mendaftar spl
        $spl = $this->splRepository->findByNim($nim);

        if ($spl != null) {
            throw new SPLIsExistsException('anda sudah pernah mendaftar SPL');
        }

        $spl = $this->splRepository->create($detailSPL, $tahunAjaran->id);

        return $spl;
    }

    function addKtp(int $id, $fileKtp)
    {
        $spl = SPL::find($id);

        if ($spl->foto_ktp != null) {
            $this->delete($spl->foto_ktp);
        }

        $dataFile = $this->uploads($fileKtp, 'spl/foto-ktp/');

        $spl->foto_ktp = $dataFile;
        $spl->save();
        return $spl;
    }

    function addBuktiPembayaran(int $id, $fileBuktiPembayaran)
    {
        $spl = SPL::find($id);

        if ($spl->bukti_pembayaran != null) {
            $this->delete($spl->bukti_pembayaran);
        }

        $filePath = $this->uploads($fileBuktiPembayaran, 'spl/bukti-pembayaran/');

        $spl->bukti_pembayaran = $filePath;
        $spl->save();

        return $spl;
    }

    function verify(int $id)
    {
        $detailSPL = [
            'is_verify' => 1
        ];
        $spl = $this->splRepository->update($id, $detailSPL);
        return $spl;
    }

    function createMessage(int $id, SPLCreateMessageRequest $request)
    {
        $pesan = $request->input('pesan');
        $detailSPL = [
            'keterangan' => $pesan,
        ];

        $spl = $this->splRepository->update($id, $detailSPL);
        return $spl;
    }

    function update(int $id, SPLUpdateRequest $request)
    {
        $noWhatsapp = $request->input('no_whatsapp');
        $jenisPendaftatan = $request->input('jenis_pendaftaran');

        $detailSPL = [
            'no_whatsapp' => $noWhatsapp,
            'jenis_pendaftaran' => $jenisPendaftatan,
        ];

        $spl = $this->splRepository->update($id, $detailSPL);

        return $spl;
    }

    public function destroy($id)
    {
        $spl = $this->splRepository->findById($id);

        if ($spl->bukti_pembayaran != null) {
            $this->delete($spl->bukti_pembayaran);
        }

        $this->splRepository->delete($id);
    }
}
