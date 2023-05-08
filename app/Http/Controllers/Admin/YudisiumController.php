<?php

namespace App\Http\Controllers\Admin;

use App\Exports\YudisiumExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\YudisiumCreateMessageRequest;
use App\Http\Requests\YudisiumUpdateRequest;
use App\Models\Yudisium;
use App\Repositories\MahasiswaRepository;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\YudisiumRepository;
use App\Services\YudisiumService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Exception;
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

    public function delete($id) {
        try {
            $this->yudisiumService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }

    public function edit($nim)
    {

        $yudisium = $this->yudisiumRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('admin.yudisium.edit', compact('yudisium', 'mahasiswa'));
    }

    public function update(YudisiumUpdateRequest $request, $id)
    {
        $fileBuktiPembayaran = $request->file('bukti_pembayaran');
        $fileBebasSpp = $request->file('bebas_spp');
        $fileTranskripNilai = $request->file('transkrip_nilai');
        $fileBebasPerpus = $request->file('bebas_perpus');
        $fileArtikel = $request->file('artikel');
        $fileSkripsi = $request->file('file_skripsi');
        $fileBebasPlagiasi = $request->file('bebas_plagiasi');
        $fileBuktiPenjilidan = $request->file('bukti_penjilidan');
        $fileBuktiPengumpulan = $request->file('bukti_pengumpulan');
        try {
            $yudisium = $this->yudisiumService->update($id, $request);
            if ($fileBuktiPembayaran != null) $this->yudisiumService->addBuktiPembayaran($id, $fileBuktiPembayaran);
            if ($fileBebasSpp != null) $this->yudisiumService->addBebasSpp($id, $fileBebasSpp);
            if ($fileTranskripNilai != null) $this->yudisiumService->addTranskripNilai($id, $fileTranskripNilai);
            if ($fileBebasPerpus != null) $this->yudisiumService->addBebasPerpus($id, $fileBebasPerpus);
            if ($fileArtikel != null) $this->yudisiumService->addArtikel($id, $fileArtikel);
            if ($fileSkripsi != null) $this->yudisiumService->addFileSkripsi($id, $fileSkripsi);
            if ($fileBebasPlagiasi != null) $this->yudisiumService->addBebasPlagiasi($id, $fileBebasPlagiasi);
            if ($fileBuktiPenjilidan != null) $this->yudisiumService->addBuktiPenjilidan($id, $fileBuktiPenjilidan);
            if ($fileBuktiPengumpulan != null) $this->yudisiumService->addBuktiPegumpulan($id, $fileBuktiPengumpulan);
            return redirect()->route('admin.yudisium.detail', $yudisium->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
}
