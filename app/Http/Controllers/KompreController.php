<?php

namespace App\Http\Controllers;

use App\Exceptions\KompreIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\KompreRegisterRequest;
use App\Http\Requests\KompreUpdateRequest;
use App\Models\BimbinganSkripsi;
use App\Models\Sempro;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\DosenRepository;
use App\Repositories\KompreRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\KompreService;
use Exception;

class KompreController extends Controller
{
    //
    private KompreService $kompreService;
    private KompreRepository $kompreRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;
    private DosenRepository $dosenRepository;


    public function __construct(KompreService $kompreService, KompreRepository $kompreRepository, MahasiswaRepository $mahasiswaRepository, BimbinganSkripsiRepository $bimbinganSkripsiRepository, DosenRepository $dosenRepository)
    {
        $this->kompreService = $kompreService;
        $this->kompreRepository = $kompreRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function list()
    {
        $kompre = $this->kompreRepository->getALl();
        return view('kompre.list', compact('kompre'));
    }

    public function formRegister($nim)
    {
        $sempro = BimbinganSkripsi::where('is_verify', 1)->where('nim', $nim)->first();
        if ($sempro == null) {
            return 'Anda belum dapat mendaftar Ujian Komprehensif';
        }
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $skripsi = $this->bimbinganSkripsiRepository->findByNim($nim);
        return view('kompre.register', compact('mahasiswa', 'skripsi'));
    }

    public function register(KompreRegisterRequest $request)
    {        
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $result = $this->kompreService->register($request);
            $this->kompreService->addBuktiPembayaran($result->id, $filePembayaran);
            return redirect()->route('kompre.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (KompreIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            dd($e);
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $kompre = $this->kompreRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $dosen = $this->dosenRepository->getAllDosen();

        return view('kompre.edit', compact('kompre', 'mahasiswa', 'dosen'));
    }

    public function update(KompreUpdateRequest $request, $id)
    {
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $kompre = $this->kompreService->update($id, $request);
            if ($filePembayaran != null) $this->kompreService->addBuktiPembayaran($id, $filePembayaran);
            return redirect()->route('kompre.detail', $kompre->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }


    public function detail($id)
    {
        $kompre = $this->kompreRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($kompre->nim);
        return view('kompre.detail', compact('kompre', 'mahasiswa'));
    }
}
