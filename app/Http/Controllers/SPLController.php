<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\SPLIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SPLRegisterRequest;
use App\Http\Requests\SPLUpdateRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\SPLRepository;
use App\Services\SPLService;
use Exception;
use Illuminate\Http\Request;

class SPLController extends Controller
{
    private SPLService $splService;
    private SPLRepository $SPLRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(SPLService $splService, SPLRepository $SPLRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->splService = $splService;
        $this->SPLRepository = $SPLRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list()
    {
        $spl = $this->SPLRepository->getALl();
        return view('spl.list', compact('spl'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('spl.register', compact('mahasiswa'));
    }

    public function register(SPLRegisterRequest $request)
    {
        // $fileKtp = $request->file('foto_ktp');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $result = $this->splService->register($request);
            // $this->splService->addKtp($result->id, $fileKtp);
            $this->splService->addBuktiPembayaran($result->id, $filePembayaran);
            return redirect()->route('spl.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } 
        // catch (PembayaranNotFoundException $e) {
        //     return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        // } 
        catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } 
        // catch (PembayaranNotSuitableWithNimException $e) {
        //     return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        // }
        catch (SPLIsExistsException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $spl = $this->SPLRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('spl.edit', compact('spl', 'mahasiswa'));
    }

    public function update(SPLUpdateRequest $request, $id)
    {
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $spl = $this->splService->update($id, $request);
            $this->splService->addBuktiPembayaran($id, $filePembayaran);
            return redirect()->route('spl.detail', $spl->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $spl = $this->SPLRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($spl->nim);
        return view('spl.detail', compact('spl', 'mahasiswa'));
    }
}
