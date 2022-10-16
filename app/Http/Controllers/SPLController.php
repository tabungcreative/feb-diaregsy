<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\SPLIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SPLRegisterRequest;
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

    public function __construct(SPLService $splService, SPLRepository $SPLRepository ,MahasiswaRepository $mahasiswaRepository)
    {
        $this->splService = $splService;
        $this->SPLRepository = $SPLRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list() {
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
        try {
            $fileKtp = $request->file('foto_ktp');
            $result = $this->splService->register($request);
            $this->splService->addKtp($result->id, $fileKtp);
            return $result;
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (PembayaranNotSuitableWithNimException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (SPLIsExistsException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            dd($e->getMessage());
            // abort(500, 'terjadi kesalahan pada server');
        }
    }
}
