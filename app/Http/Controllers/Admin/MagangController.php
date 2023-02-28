<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MagangCreateMessageRequest;
use App\Repositories\MahasiswaRepository;
use App\Repositories\MagangRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Romans\Filter\IntToRoman;
use App\Services\MagangService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MagangExport;
use App\Repositories\TahunAjaranRepository;
use Carbon\Carbon;


class MagangController extends Controller
{
    //
    private MagangService $magangService;
    private MagangRepository $magangRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;


    public function __construct(MagangService $magangService, MagangRepository $magangRepository, MahasiswaRepository $mahasiswaRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->magangService = $magangService;
        $this->magangRepository = $magangRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }


    public function index()
    {
        $title = 'Pendaftaran Kerja Praktik';
        $magang = $this->magangRepository->getALl();
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.magang.index', compact('title', 'magang','tahunAjaran'));
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
            $title = 'surat penempatan kerja praktik';
            $magang = $this->magangRepository->findById($id);
            $mahasiswa = $this->mahasiswaRepository->findByNim($magang->nim);
            $tanggal = Carbon::parse(now())->translatedFormat('d F Y');
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
            $filter = new IntToRoman();
            $rbulan = $filter->filter($bulan);

            $tanggalAkhir = Carbon::parse(now()->addDays(60))->translatedFormat('d F Y');



            $pdf = Pdf::loadView('admin.magang.pdf', compact('magang', 'mahasiswa', 'tanggal', 'bulan', 'tahun', 'rbulan', 'tanggalAkhir'));

            $pdf->setPaper('A4', 'potrait');
            return $pdf->stream($title);
        } catch (\Exception $e) {
            return response()->view('errors.500', ['message' => 'Terjadi kesalahan pada server .' . $e->getMessage()], 500);
        }
    }
}
