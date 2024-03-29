<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MengulangExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MengulangCreateMessageRequest;
use App\Http\Requests\MengulangUpdateRequest;
use App\Models\Mengulang;
use App\Repositories\MahasiswaRepository;
use App\Repositories\MengulangRepository;
use App\Repositories\TahunAjaranRepository;
use App\Services\MengulangService;
use Carbon\Carbon;
use Exception;
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
        $mengulang = Mengulang::orderBy('is_verify', 'ASC')->paginate(20);

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


    public function delete($id) {
        try {
            $this->mengulangService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $mengulang = $this->mengulangRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('admin.mengulang.edit', compact('mengulang', 'mahasiswa'));
    }

    public function update(MengulangUpdateRequest $request, $id)
    {
        $fileKhs = $request->file('khs');
        $filePembayaran = $request->file('bukti_pembayaran');
        try {
            $mengulang = $this->mengulangService->update($id, $request);
            if ($fileKhs != null) $this->mengulangService->addKhs($mengulang->id, $fileKhs);
            if ($filePembayaran != null) $this->mengulangService->addBuktiPembayaran($mengulang->id, $filePembayaran);
            return redirect()->route('admin.mengulang.detail', $mengulang->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
}

