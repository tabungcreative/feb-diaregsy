<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SPLExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SPLCreateMessageRequest;
use App\Http\Requests\SPLUpdateRequest;
use App\Models\SPL;
use App\Repositories\MahasiswaRepository;
use App\Repositories\SPLRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\SPLService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SPLController extends Controller
{

    private SPLService $SPLService;
    private SPLRepository $SPLRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(
        SPLService $SPLService,
        SPLRepository $SPLRepository,
        MahasiswaRepository $mahasiswaRepository,
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->SPLService = $SPLService;
        $this->SPLRepository = $SPLRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;

    }

    public function index(Request $request)
    {
        $title = 'Pendaftaran Studi Ekskursi';
        $spl = SPL::orderBy('is_verify', 'ASC')->paginate(20);
        $key = $request->get('key');
        if ($key != null) {
            $spl = SPL::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.spl.index', compact('title', 'spl','tahunAjaran'));
    }

    public function detail($id)
    {
        $spl = $this->SPLRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($spl->nim);
        return view('admin.spl.detail', compact('spl', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->SPLService->verify($id);
            return redirect()->route('admin.spl.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(SPLCreateMessageRequest $request, $id)
    {
        try {
            $this->SPLService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new SPLExport(), 'daftar-spl-' . $tahun . '.xlsx');
    }

    public function delete($id) {
        try {
            $this->SPLService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $spl = $this->SPLRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('admin.spl.edit', compact('spl', 'mahasiswa'));
    }

    public function update(SPLUpdateRequest $request, $id)
    {
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $spl = $this->SPLService->update($id, $request);
            if ($filePembayaran != null) $this->SPLService->addBuktiPembayaran($id, $filePembayaran);
            return redirect()->route('admin.spl.detail', $spl->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
}
