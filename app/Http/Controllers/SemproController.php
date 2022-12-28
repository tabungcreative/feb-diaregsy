<?php

namespace App\Http\Controllers;

use App\Exceptions\SemproIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\SemproRepository;
use App\Services\SemproService;
use Exception;
use Illuminate\Http\Request;

class SemproController extends Controller
{


    private SemproService $semproService;
    private SemproRepository $semproRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(SemproService $semproService, SemproRepository $semproRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->semproService = $semproService;
        $this->semproRepository = $semproRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list()
    {
        $sempro = $this->semproRepository->getALl();
        return view('sempro.list', compact('sempro'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('sempro.register', compact('mahasiswa'));
    }

    public function register(SemproRegisterRequest $request)
    {
        try {
            $notaKaprodi = $request->file('nota_kaprodi');
            $berkasSempro = $request->file('berkas_sempro');
            $result = $this->semproService->register($request);

            $this->semproService->addNotaKaprodi($result->id, $notaKaprodi);
            $this->semproService->addBerkasSempro($result->id, $berkasSempro);
            return redirect()->route('sempro.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotSuitableWithNimException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (SemproIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $sempro = $this->semproRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('sempro.edit', compact('sempro', 'mahasiswa'));
    }

    public function update(SemproUpdateRequest $request, $id)
    {
        $notaKaprodi = $request->file('nota_kaprodi');
        $berkasSempro = $request->file('berkas_sempro');
        try {
            $sempro = $this->semproService->update($id, $request);
            $this->semproService->addNotaKaprodi($sempro->id, $notaKaprodi);
            $this->semproService->addBerkasSempro($sempro->id, $berkasSempro);
            return redirect()->route('sempro.detail', $sempro->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }




    public function detail($id)
    {
        $sempro = $this->semproRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($sempro->nim);
        return view('sempro.detail', compact('sempro', 'mahasiswa'));
    }
}
