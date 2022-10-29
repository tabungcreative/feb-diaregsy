<?php

namespace App\Http\Controllers;

use App\Exceptions\BimbinganSkripsiIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Http\Requests\BimbinganSkripsiUpdateRequest;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\DosenRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\BimbinganSkripsiService;
use Exception;
use Illuminate\Http\Request;

class BimbinganSkripsiController extends Controller
{
    //
    public function __construct(BimbinganSkripsiService $bimbinganSkripsiService, BimbinganSkripsiRepository $bimbinganSkripsiRepository, MahasiswaRepository $mahasiswaRepository, DosenRepository $dosenRepository)
    {
        $this->bimbinganSkripsiService = $bimbinganSkripsiService;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function list()
    {
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->getALl();
        return view('bimbinganSkripsi.list', compact('bimbinganSkripsi'));
    }


    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $dosen = $this->dosenRepository->getAllDosen();
        return view('bimbinganSkripsi.register', compact('mahasiswa', 'dosen'));
    }

    public function register(BimbinganSkripsiRegisterRequest $request)
    {
        try {
            $result = $this->bimbinganSkripsiService->register($request);
            return redirect()->route('bimbinganSkripsi.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotSuitableWithNimException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (BimbinganSkripsiIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $dosen = $this->dosenRepository->getAllDosen();

        return view('bimbinganSkripsi.edit', compact('bimbinganSkripsi', 'mahasiswa', 'dosen'));
    }

    public function update(BimbinganSkripsiUpdateRequest $request, $id)
    {
        try {
            $bimbinganSkripsi = $this->bimbinganSkripsiService->update($id, $request);
            return redirect()->route('bimbinganSkripsi.detail', $bimbinganSkripsi->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($bimbinganSkripsi->nim);
        return view('bimbinganSkripsi.detail', compact('bimbinganSkripsi', 'mahasiswa'));
    }
}
