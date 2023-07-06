<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UjianAkhirExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UjianAkhirAddTanggalUjianRequest;
use App\Http\Requests\UjianAkhirCreateMessageRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Http\Requests\UjianAkhirUpdateStatusRequest;
use App\Models\UjianAkhir;
use App\Repositories\DosenRepository;
use App\Repositories\MahasiswaRepository;
use App\Repositories\TahunAjaranRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\UjianAkhirService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class UjianAkhirController extends Controller
{
    //
    private UjianAkhirService $ujianAkhirService;
    private UjianAkhirRepository $ujianAkhirRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private TahunAjaranRepository $tahunAjaranRepository;
    private DosenRepository $dosenRepository;


    public function __construct(UjianAkhirService $ujianAkhirService, UjianAkhirRepository $ujianAkhirRepository, MahasiswaRepository $mahasiswaRepository,TahunAjaranRepository $tahunAjaranRepository, DosenRepository $dosenRepository)
    {
        $this->ujianAkhirService = $ujianAkhirService;
        $this->ujianAkhirRepository = $ujianAkhirRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function index(Request $request)
    {
        $title = 'Pendaftaran Ujian Tugas Akhir';
        $ujianAkhir = UjianAkhir::orderBy('is_verify', 'ASC')->orderBy('status', 'DESC')->paginate(20);

        $key = $request->get('key');
        if ($key != null) {
            $ujianAkhir = UjianAkhir::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }

        $tahunAjaran = $this->tahunAjaranRepository->findByIsActive();
        return view('admin.ujianAkhir.index', compact('title', 'ujianAkhir','tahunAjaran'));
    }

    public function detail($id)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($ujianAkhir->nim);
        return view('admin.ujianAkhir.detail', compact('ujianAkhir', 'mahasiswa'));
    }

    public function verify($id)
    {
        try {
            $this->ujianAkhirService->verify($id);
            return redirect()->route('admin.ujianAkhir.index')->with('success', 'Pendaftaran Berhasil Terverifikasi');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function createMessage(UjianAkhirCreateMessageRequest $request, $id)
    {
        try {
            $this->ujianAkhirService->createMessage($id, $request);
            return redirect()->back()->with('success', 'Berhasil menambah pesan / ketarangan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }
    public function export()
    {
        $tahun = Carbon::now()->year;
        return Excel::download(new UjianAkhirExport(), 'daftar-ujian-akhir-' . $tahun . '.xlsx');
    }

    public function delete($id) {
        try {
            $this->ujianAkhirService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $dosen = $this->dosenRepository->getAllDosen();
        $ujianAkhir = $this->ujianAkhirRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);


        return view('admin.ujianAkhir.edit', compact('ujianAkhir', 'mahasiswa','dosen'));
    }

    public function update(UjianAkhirUpdateRequest $request, $id)
    {
        $fileSkripsi = $request->file('berkas_skripsi');
        $fileIjazahTerakhir = $request->file('ijazah_terakhir');
        $fileTranskripNilai = $request->file('transkrip_nilai');
        $fileAkta = $request->file('akta_kelahiran');
        $fileKK = $request->file('kartu_keluarga');
        $fileKtp = $request->file('ktp');
        $fileLembarBimbingan = $request->file('lembar_bimbingan');
        $fileSlipSemesterTerakhir = $request->file('slip_pembayaransemesterterakhir');
        $filePembayaranSkripsi = $request->file('slip_pembayaranSkripsi');
        $fileSertifikat = $request->file('sertifikat');
        try {
            $ujianAkhir = $this->ujianAkhirService->update($id, $request);
            if ($fileSkripsi != null) $this->ujianAkhirService->addBerkasSkripsi($id, $fileSkripsi);
            if ($fileIjazahTerakhir != null) $this->ujianAkhirService->addIjazahTerakhir($id, $fileIjazahTerakhir);
            if ($fileTranskripNilai != null) $this->ujianAkhirService->addTranskripNilai($id, $fileTranskripNilai);
            if ($fileAkta != null) $this->ujianAkhirService->addAkta($id, $fileAkta);
            if ($fileKK != null) $this->ujianAkhirService->addKK($id, $fileKK);
            if ($fileKtp != null) $this->ujianAkhirService->addKtp($id, $fileKtp);
            if ($fileLembarBimbingan != null) $this->ujianAkhirService->addLembarBimbingan($id, $fileLembarBimbingan);
            if ($fileSlipSemesterTerakhir != null) $this->ujianAkhirService->addSlipSemesterTerakhir($id, $fileSlipSemesterTerakhir);
            if ($filePembayaranSkripsi != null) $this->ujianAkhirService->addPembayaranSkripsi($id, $filePembayaranSkripsi);
            if ($fileSertifikat != null) $this->ujianAkhirService->addSertifikat($id, $fileSertifikat);
            return redirect()->route('admin.ujianAkhir.detail', $ujianAkhir->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function updateStatus($id, UjianAkhirUpdateStatusRequest $request) {
        try {
            $this->ujianAkhirService->changeStatus($id, $request);
            return redirect()->back()->with('success', 'Berhasil mengubah status pendaftaran');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function addTanggalUjian($id, UjianAkhirAddTanggalUjianRequest $request) {
        try {
            $this->ujianAkhirService->addTanggalUjian($id, $request);
            return redirect()->back()->with('success', 'Berhasil mengubah status pendaftaran');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }
}
