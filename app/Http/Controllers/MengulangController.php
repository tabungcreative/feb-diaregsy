<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\MengulangIsExistException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MengulangRegisterRequest;
use App\Http\Requests\MengulangUpdateRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\MengulangRepository;
use App\Services\MengulangService;
use Exception;
use Illuminate\Http\Request;

class MengulangController extends Controller
{
    //

    private MengulangService $mengulangService;
    private MengulangRepository $mengulangRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(MengulangService $mengulangService, MengulangRepository $mengulangRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->mengulangService = $mengulangService;
        $this->mengulangRepository = $mengulangRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list()
    {
        $mengulang = $this->mengulangRepository->getALl();
        return view('mengulang.list', compact('mengulang'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('mengulang.register', compact('mahasiswa'));
    }

    public function register(MengulangRegisterRequest $request)
    {
        $fileKhs = $request->file('khs');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $result = $this->mengulangService->register($request);
            $this->mengulangService->addKhs($result->id, $fileKhs);
            $this->mengulangService->addBuktiPembayaran($result->id, $filePembayaran);
            return redirect()->route('mengulang.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
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
        catch (MengulangIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            // dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $mengulang = $this->mengulangRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('mengulang.edit', compact('mengulang', 'mahasiswa'));
    }

    public function update(MengulangUpdateRequest $request, $id)
    {
        $fileKhs = $request->file('khs');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $mengulang = $this->mengulangService->update($id, $request);
            $this->mengulangService->addKhs($mengulang->id, $fileKhs);
            $this->mengulangService->addBuktiPembayaran($mengulang->id, $filePembayaran);
            return redirect()->route('mengulang.detail', $mengulang->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $mengulang = $this->mengulangRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($mengulang->nim);
        return view('mengulang.detail', compact('mengulang', 'mahasiswa'));
    }
}
