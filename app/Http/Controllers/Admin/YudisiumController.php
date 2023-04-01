<?php

namespace App\Http\Controllers\Admin;

use App\Exports\YudisiumExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\YudisiumCreateMessageRequest;
use App\Models\Yudisium;
use App\Repositories\MahasiswaRepository;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\YudisiumRepository;
use App\Services\YudisiumService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class YudisiumController extends Controller
{
    //
    private YudisiumService $yudisiumService;
    private YudisiumRepository $yudisiumRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;


    public function __construct(YudisiumService $yudisiumService, YudisiumRepository $yudisiumRepository, MahasiswaRepository $mahasiswaRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->yudisiumService = $yudisiumService;
        $this->yudisiumRepository = $yudisiumRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }

    public function index(Request $request)
    {
        $title = 'Pendaftaran Yudisium';
        $yudisium = Yudisium::orderBy('is_verify', 'ASC')->paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $yudisium = Yudisium::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();

        return view('admin.yudisium.index', compact('title', 'yudisium','tahunAjaran'));
    }

    public function detail($id)
    {
        $yudisium = $this->yudisiumRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($yudisium->nim);
        return view('admin.yudisium.detail', compact('yudisium', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->yudisiumService->verify($id);
            return redirect()->route('admin.yudisium.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(YudisiumCreateMessageRequest $request, $id)
    {
        try {
            $this->yudisiumService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }


    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new YudisiumExport(), 'daftar-yudisium-' . $tahun . '.xlsx');
    }
}
