<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BimbinganSkripsiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\BimbinganSkripsiCreateMessageRequest;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\DosenRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\BimbinganSkripsiService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
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


    public function index()
    {
        $title = 'Pendaftaran Bimbingan Skripsi';
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->getALl();
        return view('admin.bimbinganSkripsi.index', compact('title', 'bimbinganSkripsi'));
    }
    public function detail($id)
    {
        $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($bimbinganSkripsi->nim);
        return view('admin.bimbinganSkripsi.detail', compact('bimbinganSkripsi', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->bimbinganSkripsiService->verify($id);
            return redirect()->route('admin.bimbinganSkripsi.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(BimbinganSkripsiCreateMessageRequest $request, $id)
    {
        try {
            $this->bimbinganSkripsiService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }


    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new BimbinganSkripsiExport(), 'daftar-bimbingan-skripsi' . $tahun . '.xlsx');
    }
}
