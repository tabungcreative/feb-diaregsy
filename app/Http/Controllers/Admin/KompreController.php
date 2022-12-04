<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KompreExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\KompreCreateMessageRequest;
use App\Repositories\DosenRepository;
use App\Repositories\KompreRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\KompreService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class KompreController extends Controller
{
    //
    private KompreService $kompreService;
    private KompreRepository $kompreRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private DosenRepository $dosenRepository;


    public function __construct(KompreService $kompreService, KompreRepository $kompreRepository, MahasiswaRepository $mahasiswaRepository, DosenRepository $dosenRepository)
    {
        $this->kompreService = $kompreService;
        $this->kompreRepository = $kompreRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function index()
    {
        $title = 'Pendaftaran Ujian Komprehensif';
        $kompre = $this->kompreRepository->getALl();
        return view('admin.kompre.index', compact('title', 'kompre'));
    }

    public function detail($id)
    {
        $kompre = $this->kompreRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($kompre->nim);
        return view('admin.kompre.detail', compact('kompre', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->kompreService->verify($id);
            return redirect()->route('admin.kompre.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(KompreCreateMessageRequest $request, $id)
    {
        try {
            $this->kompreService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new KompreExport(), 'daftar-ujian-komprehensif-' . $tahun . '.xlsx');
    }
}
