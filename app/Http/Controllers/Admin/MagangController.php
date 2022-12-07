<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MagangExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MagangCreateMessageRequest;
use App\Repositories\MagangRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\MagangService;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function print($id)
    {
        try {
            $title = 'surat penempatan magang';
            $magang = $this->magangRepository->findById($id);
            $mahasiswa = $this->mahasiswaRepository->findByNim($magang->nim);
            $tanggal = Carbon::parse(now())->translatedFormat('d F Y');

            // $kop = base64_encode(file_get_contents(public_path('')));
            // $footerKop = base64_encode(file_get_contents(public_path('')));

            $pdf = Pdf::loadView('admin.magang.pdf', compact('magang', 'mahasiswa', 'tanggal'));

            $pdf->setPaper('a4', 'potrait');
            return $pdf->stream($title);
        } catch (\Exception $e) {
            return response()->view('errors.500', ['message' => 'Terjadi kesalahan pada server .' . $e->getMessage()], 500);
        }
    }
}
