<?php

namespace App\Services\Impl;

use App\Exceptions\SPLIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SPLRegisterRequest;
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
        $noPembayaran = $request->input('no_pembayaran');
        $noWhatsapp = $request->input('no_whatsapp');
        $jenisPendaftaran = $request->input('jenis_pendaftaran');

        // cek pembayaran
        $this->pembayaranService->checkPembayaran($noPembayaran, $nim);

        $detailSPL = [
            'nim' => $nim,
            'no_pembayaran' => $noPembayaran,
            'foto_ktp' => null,
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

        $dataFile = $this->uploads($fileKtp, 'pengumuman/');

        $filePath = $dataFile['filePath'];

        $spl->foto_ktp = $filePath;
        $spl->save();

        return $spl;
    }
}
