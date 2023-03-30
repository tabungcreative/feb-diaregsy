<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KompreExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\KompreCreateMessageRequest;
use App\Models\Kompre;
use App\Repositories\DosenRepository;
use App\Repositories\KompreRepository;
use App\Repositories\MahasiswaRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\KompreService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KompreController extends Controller
{
    //
    private KompreService $kompreService;
    private KompreRepository $kompreRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private DosenRepository $dosenRepository;
    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(KompreService $kompreService, KompreRepository $kompreRepository, MahasiswaRepository $mahasiswaRepository, DosenRepository $dosenRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->kompreService = $kompreService;
        $this->kompreRepository = $kompreRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }

    public function index(Request $request)
    {
        $title = 'Pendaftaran Ujian Komprehensif';
        $kompre = Kompre::paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $kompre = Kompre::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }
        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.kompre.index', compact('title', 'kompre','tahunAjaran'));
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
