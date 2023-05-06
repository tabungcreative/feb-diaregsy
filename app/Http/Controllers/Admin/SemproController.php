<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SemproExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Models\Sempro;
use App\Repositories\MahasiswaRepository;
use App\Repositories\SemproRepository;
use App\Repositories\TahunAjaranRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\SemproService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SemproController extends Controller
{
    //
    private SemproService $semproService;
    private SemproRepository $semproRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;


    public function __construct(SemproService $semproService, SemproRepository $semproRepository, MahasiswaRepository $mahasiswaRepository,TahunAjaranRepository $tahunAjaranRepository)
    {
        $this->semproService = $semproService;
        $this->semproRepository = $semproRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }

    public function index(Request $request)
    {
        $title = 'Pendaftaran Seminar Proposal';
        $sempro = Sempro::orderBy('is_verify', 'ASC')->paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $sempro = Sempro::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.sempro.index', compact('title', 'sempro','tahunAjaran'));
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

    public function delete($id) {
        try {
            $this->semproService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $sempro = $this->semproRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('admin.sempro.edit', compact('sempro', 'mahasiswa'));
    }

    public function update(SemproUpdateRequest $request, $id)
    {
        $notaKaprodi = $request->file('nota_kaprodi');
        $berkasSempro = $request->file('berkas_sempro');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $sempro = $this->semproService->update($id, $request);
            if ($notaKaprodi != null) $this->semproService->addNotaKaprodi($sempro->id, $notaKaprodi);
            if ($berkasSempro != null) $this->semproService->addBerkasSempro($sempro->id, $berkasSempro);
            if ($filePembayaran != null) $this->semproService->addBuktiPembayaran($sempro->id, $filePembayaran);
            return redirect()->route('admin.sempro.detail', $sempro->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
}
