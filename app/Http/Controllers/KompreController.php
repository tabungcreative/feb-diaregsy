<?php

namespace App\Http\Controllers;

use App\Exceptions\KompreIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\KompreRegisterRequest;
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




    public function __construct(KompreService $kompreService, KompreRepository $kompreRepository, MahasiswaRepository $mahasiswaRepository, BimbinganSkripsiRepository $bimbinganSkripsiRepository)
    {
        $this->kompreService = $kompreService;
        $this->kompreRepository = $kompreRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
    }

    public function list()
    {
        $kompre = $this->kompreRepository->getALl();
        return view('kompre.list', compact('kompre'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $skripsi = $this->bimbinganSkripsiRepository->findByNim($nim);
        return view('kompre.register', compact('mahasiswa', 'skripsi'));
    }

    public function register(KompreRegisterRequest $request)
    {
        try {
            $result = $this->kompreService->register($request);
            return redirect()->route('kompre.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (KompreIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
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
