<?php

namespace App\Http\Controllers;

use App\Exceptions\BimbinganSkripsiIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Http\Requests\BimbinganSkripsiUpdateRequest;
use App\Models\BimbinganSkripsi;
use App\Models\Sempro;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\DosenRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\BimbinganSkripsiService;
use Exception;
use Illuminate\Http\Request;

class BimbinganSkripsiController extends Controller
{
    private BimbinganSkripsiService $bimbinganSkripsiService;
    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private DosenRepository $dosenRepository;

    public function __construct(BimbinganSkripsiService $bimbinganSkripsiService, BimbinganSkripsiRepository $bimbinganSkripsiRepository, MahasiswaRepository $mahasiswaRepository, DosenRepository $dosenRepository)
    {
        $this->bimbinganSkripsiService = $bimbinganSkripsiService;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function list(Request $request)
    {
        $bimbinganSkripsi = BimbinganSkripsi::orderBy('created_at', 'DESC')->simplePaginate(20);
        $key = $request->get('key');
        if ($key != null) {
            $bimbinganSkripsi = BimbinganSkripsi::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }
        return view('bimbinganSkripsi.list', compact('bimbinganSkripsi'));
    }


    public function formRegister($nim)
    {
        $sempro = Sempro::where('is_verify', 1)->where('status', 'Lulus')->where('nim', $nim)->first();
        if ($sempro == null) {
            return view('pendaftaran.not-registered', ['message' => 'Anda belum dapat mendaftar Bimbingan Tugas Akhir']);
        }
        // if($sempro->status != 'Lulus') {
        //     return view('pendaftaran.not-registered', ['message' => 'Anda belum dapat mendaftar Bimbingan Tugas Akhir']);
        // }
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $dosen = $this->dosenRepository->getAllDosen();
        return view('bimbinganSkripsi.register', compact('mahasiswa', 'dosen'));
    }

    public function register(BimbinganSkripsiRegisterRequest $request)
    {
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $result = $this->bimbinganSkripsiService->register($request);
            $this->bimbinganSkripsiService->addBuktiPembayaran($result->id, $filePembayaran);
            return redirect()->route('bimbinganSkripsi.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
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
        catch (BimbinganSkripsiIsExistException $e) {
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
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $bimbinganSkripsi = $this->bimbinganSkripsiService->update($id, $request);
            if ($filePembayaran != null) $this->bimbinganSkripsiService->addBuktiPembayaran($id, $filePembayaran);
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
