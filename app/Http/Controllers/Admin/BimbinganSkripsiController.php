<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BimbinganSkripsiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\BimbinganSkripsiCreateMessageRequest;
use App\Models\BimbinganSkripsi;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\MahasiswaRepository;
use App\Services\BimbinganSkripsiService;
use App\Repositories\DosenRepository;
use App\Repositories\TahunAjaranRepository;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Romans\Filter\IntToRoman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BimbinganSkripsiController extends Controller
{
    //
    private BimbinganSkripsiService $bimbinganSkripsiService;
    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private DosenRepository $dosenRepository;
    private TahunAjaranRepository $tahunAjaranRepository;


    public function __construct(BimbinganSkripsiService $bimbinganSkripsiService, BimbinganSkripsiRepository $bimbinganSkripsiRepository, MahasiswaRepository $mahasiswaRepository, DosenRepository $dosenRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->bimbinganSkripsiService = $bimbinganSkripsiService;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }


    public function index(Request $request)
    {
        $title = 'Pendaftaran Bimbingan Tugas Akhir';
        $bimbinganSkripsi = BimbinganSkripsi::orderBy('is_verify', 'ASC')->paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $bimbinganSkripsi = BimbinganSkripsi::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.bimbinganSkripsi.index', compact('title', 'bimbinganSkripsi','tahunAjaran'));
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

    public function suratTugas($id)
    {
        try {
            $title = 'surat tugas bimbingan';
            $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findById($id);
            $mahasiswa = $this->mahasiswaRepository->findByNim($bimbinganSkripsi->nim);
            $tanggal = Carbon::parse(now())->translatedFormat('d F Y');
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;
            $filter = new IntToRoman();
            $rbulan = $filter->filter($bulan);


            $pdf = Pdf::loadView('admin.bimbinganSkripsi.surat_tugas', compact('bimbinganSkripsi', 'mahasiswa', 'bulan', 'tahun', 'rbulan', 'tanggal'));

            $pdf->setPaper('A4', 'potrait');
            return $pdf->stream($title);
        } catch (\Exception $e) {
            return response()->view('errors.500', ['message' => 'Terjadi kesalahan pada server .' . $e->getMessage()], 500);
        }
    }

    public function suratBimbingan($id)
    {
        try {
            $title = 'surat tugas bimbingan';
            $bimbinganSkripsi = $this->bimbinganSkripsiRepository->findById($id);
            $mahasiswa = $this->mahasiswaRepository->findByNim($bimbinganSkripsi->nim);
            $tanggal = Carbon::parse(now())->translatedFormat('d F Y');

            // $kop = base64_encode(file_get_contents(public_path('')));
            // $footerKop = base64_encode(file_get_contents(public_path('')));

            $pdf = Pdf::loadView('admin.bimbinganSkripsi.surat_bimbingan', compact('bimbinganSkripsi', 'mahasiswa', 'tanggal'));

            $pdf->setPaper('A4', 'potrait');
            return $pdf->stream($title);
        } catch (\Exception $e) {
            return response()->view('errors.500', ['message' => 'Terjadi kesalahan pada server .' . $e->getMessage()], 500);
        }
    }
}
