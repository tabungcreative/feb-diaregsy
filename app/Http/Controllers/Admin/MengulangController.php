<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MengulangExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MengulangCreateMessageRequest;
use App\Models\Mengulang;
use App\Repositories\MahasiswaRepository;
use App\Repositories\MengulangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\MengulangService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MengulangController extends Controller
{
    //
    private MengulangService $mengulangService;
    private MengulangRepository $mengulangRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;


    public function __construct(MengulangService $mengulangService, MengulangRepository $mengulangRepository, MahasiswaRepository $mahasiswaRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->mengulangService = $mengulangService;
        $this->mengulangRepository = $mengulangRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;

    }
    public function index(Request $request)
    {
        $title = 'Pendaftaran Mengulang';
        $mengulang = Mengulang::paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $mengulang = Mengulang::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.mengulang.index', compact('title', 'mengulang','tahunAjaran'));
    }

    public function detail($id)
    {
        $mengulang = $this->mengulangRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($mengulang->nim);
        return view('admin.mengulang.detail', compact('mengulang', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->mengulangService->verify($id);
            return redirect()->route('admin.mengulang.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(MengulangCreateMessageRequest $request, $id)
    {
        try {
            $this->mengulangService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new MengulangExport(), 'daftar-mengulang-' . $tahun . '.xlsx');
    }
}

