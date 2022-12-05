<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UjianAkhirExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UjianAkhirCreateMessageRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\UjianAkhirService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class UjianAkhirController extends Controller
{
    //
    private UjianAkhirService $ujianAkhirService;
    private UjianAkhirRepository $ujianAkhirRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(UjianAkhirService $ujianAkhirService, UjianAkhirRepository $ujianAkhirRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->ujianAkhirService = $ujianAkhirService;
        $this->ujianAkhirRepository = $ujianAkhirRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function index()
    {
        $title = 'Pendaftaran Ujian Akhir';
        $ujianAkhir = $this->ujianAkhirRepository->getALl();
        return view('admin.ujianAkhir.index', compact('title', 'ujianAkhir'));
    }

    public function detail($id)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($ujianAkhir->nim);
        return view('admin.ujianAkhir.detail', compact('ujianAkhir', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->ujianAkhirService->verify($id);
            return redirect()->route('admin.ujianAkhir.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(UjianAkhirCreateMessageRequest $request, $id)
    {
        try {
            $this->ujianAkhirService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }
    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new UjianAkhirExport(), 'daftar-ujian-akhir-' . $tahun . '.xlsx');
    }
}
