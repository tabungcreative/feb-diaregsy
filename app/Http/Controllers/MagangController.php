<?php

namespace App\Http\Controllers;

use App\Exceptions\MagangIsExistException;
use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MagangRegisterRequest;
use App\Http\Requests\MagangUpdateRequest;
use App\Models\Magang;
use App\Repositories\MagangRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\MagangService;
use Exception;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    private MagangService $magangService;
    private MagangRepository $magangRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(MagangService $magangService, MagangRepository $magangRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->magangService = $magangService;
        $this->magangRepository = $magangRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function list(Request $request)
    {
        $magang = Magang::orderBy('created_at', 'DESC')->simplePaginate(20);
        $key = $request->get('key');
        if ($key != null) {
            $magang = Magang::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->simplePaginate(20);
        }
        return view('magang.list', compact('magang'));
    }

    public function formRegister($nim)
    {
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        return view('magang.register', compact('mahasiswa'));
    }

    public function register(MagangRegisterRequest $request)
    {
        $lembarPersetujuan = $request->file('lembar_persetujuan');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $result = $this->magangService->register($request);
            $this->magangService->addLembarPersetujuan($result->id, $lembarPersetujuan);
            $this->magangService->addBuktiPembayaran($result->id, $filePembayaran);
            return redirect()->route('magang.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
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
        catch (MagangIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            // dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $magang = $this->magangRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('magang.edit', compact('magang', 'mahasiswa'));
    }

    public function update(MagangUpdateRequest $request, $id)
    {
        $lembarPersetujuan = $request->file('lembar_persetujuan');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $magang = $this->magangService->update($id, $request);
            if ($lembarPersetujuan != null) $this->magangService->addLembarPersetujuan($id, $lembarPersetujuan);
            if ($filePembayaran != null) $this->magangService->addBuktiPembayaran($id, $filePembayaran);
            return redirect()->route('magang.detail', $magang->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            // dd($exception);
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $magang = $this->magangRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($magang->nim);
        return view('magang.detail', compact('magang', 'mahasiswa'));
    }
}
