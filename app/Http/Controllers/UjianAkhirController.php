<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\UjianAkhirIsExistException;
use App\Http\Requests\UjianAkhirRegisterRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\UjianAkhirService;
use Exception;

class UjianAkhirController extends Controller
{
    //
    private UjianAkhirService $ujianAkhirService;
    private UjianAkhirRepository $ujianAkhirRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(UjianAkhirService $ujianAkhirService, UjianAkhirRepository $ujianAkhirRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->ujianAkhirService = $ujianAkhirService;
        $this->ujianAkhirRepository = $ujianAkhirRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list()
    {
        $ujianAkhir = $this->ujianAkhirRepository->getALl();
        return view('ujianAkhir.list', compact('ujianAkhir'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('ujianAkhir.register', compact('mahasiswa'));
    }

    public function register(UjianAkhirRegisterRequest $request)
    {
        try {
            $fileSkripsi = $request->file('berkas_skripsi');
            $fileIjazahTerakhir = $request->file('ijazah_terakhir');
            $fileTranskripNilai = $request->file('transkrip_nilai');
            $fileAkta = $request->file('akta_kelahiran');
            $fileKK = $request->file('kartu_keluarga');
            $fileKtp = $request->file('ktp');
            $fileLembarBimbingan = $request->file('lembar_bimbingan');
            $fileSlipSemesterTerakhir = $request->file('slip_pembayaransemesterterakhir');
            $filePembayaranSkripsi = $request->file('slip_pembayaranSkripsi');
            $fileSertifikat = $request->file('sertifikat');
            $result = $this->ujianAkhirService->register($request);
            $this->ujianAkhirService->addBerkasSkripsi($result->id, $fileSkripsi);
            $this->ujianAkhirService->addIjazahTerakhir($result->id, $fileIjazahTerakhir);
            $this->ujianAkhirService->addTranskripNilai($result->id, $fileTranskripNilai);
            $this->ujianAkhirService->addAkta($result->id, $fileAkta);
            $this->ujianAkhirService->addKK($result->id, $fileKK);
            $this->ujianAkhirService->addKtp($result->id, $fileKtp);
            $this->ujianAkhirService->addLembarBimbingan($result->id, $fileLembarBimbingan);
            $this->ujianAkhirService->addSlipSemesterTerakhir($result->id, $fileSlipSemesterTerakhir);
            $this->ujianAkhirService->addPembayaranSkripsi($result->id, $filePembayaranSkripsi);
            $this->ujianAkhirService->addSertifikat($result->id, $fileSertifikat);
            return redirect()->route('ujianAkhir.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (UjianAkhirIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
            dd($e);
        }
    }

    public function edit($nim)
    {
        $ujianAkhir = $this->UjianAkhirRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('ujianAkhir.edit', compact('ujianAkhir', 'mahasiswa'));
    }

    public function update(UjianAkhirUpdateRequest $request, $id)
    {
        try {
            $ujianAkhir = $this->ujianAkhirService->update($id, $request);
            return redirect()->route('ujianAkhir.detail', $ujianAkhir->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $ujianAkhir = $this->UjianAkhirRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($ujianAkhir->nim);
        return view('ujianAkhir.detail', compact('ujianAkhir', 'mahasiswa'));
    }
}

    // function addSertifikat(int $id, $fileSertifikat);
