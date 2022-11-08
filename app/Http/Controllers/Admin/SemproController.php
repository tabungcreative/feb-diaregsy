<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SemproExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\SemproRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\SemproService;
use Carbon\Carbon;



class SemproController extends Controller
{
    //
    private SemproService $semproService;
    private SemproRepository $semproRepository;
    private MahasiswaRepository $mahasiswaRepository;

    public function __construct(SemproService $semproService, SemproRepository $semproRepository, MahasiswaRepository $mahasiswaRepository)
    {
        $this->semproService = $semproService;
        $this->semproRepository = $semproRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function index()
    {
        $title = 'Pendaftaran Seminar Proposal';
        $sempro = $this->semproRepository->getALl();
        return view('admin.sempro.index', compact('title', 'sempro'));
    }

    public function detail($id)
    {
        $sempro = $this->semproRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($sempro->nim);
        return view('admin.sempro.detail', compact('sempro', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->semproService->verify($id);
            return redirect()->route('admin.sempro.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(SemproCreateMessageRequest $request, $id)
    {
        try {
            $this->semproService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new SemproExport(), 'daftar-seminar-proposal-' . $tahun . '.xlsx');
    }
}
