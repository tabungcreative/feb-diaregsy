<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MagangExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MagangCreateMessageRequest;
use App\Repositories\MagangRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\MagangService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MagangController extends Controller
{
    //
    private MagangService $magangService;
    private MagangRepository $magangRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(MagangService $magangService, MagangRepository $magangRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->magangService = $magangService;
        $this->magangRepository = $magangRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }


    public function index()
    {
        $title = 'Pendaftaran Magang';
        $magang = $this->magangRepository->getALl();
        return view('admin.magang.index', compact('title', 'magang'));
    }
    public function detail($id)
    {
        $magang = $this->magangRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($magang->nim);
        return view('admin.magang.detail', compact('magang', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->magangService->verify($id);
            return redirect()->route('admin.magang.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(MagangCreateMessageRequest $request, $id)
    {
        try {
            $this->magangService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }


    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new MagangExport(), 'daftar-magang-' . $tahun . '.xlsx');
    }
}
