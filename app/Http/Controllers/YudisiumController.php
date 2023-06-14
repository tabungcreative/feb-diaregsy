<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\YudisiumIsExistException;
use App\Http\Requests\YudisiumRegisterRequest;
use App\Http\Requests\YudisiumUpdateRequest;
use App\Models\UjianAkhir;
use App\Models\Yudisium;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\GroupYudisiumRepository;
use App\Repositories\MahasiswaRepository;
use App\Repositories\YudisiumRepository;
use App\Services\YudisiumService;
use Exception;
use Illuminate\Http\Request;

class YudisiumController extends Controller
{
    //
    private YudisiumService $yudisiumService;
    private YudisiumRepository $yudisiumRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;
    private GroupYudisiumRepository $groupYudisiumRepository;

    public function __construct(YudisiumService $yudisiumService, YudisiumRepository $yudisiumRepository, MahasiswaRepository $mahasiswaRepository, BimbinganSkripsiRepository $bimbinganSkripsiRepository, GroupYudisiumRepository $groupYudisiumRepository)
    {
        $this->yudisiumService = $yudisiumService;
        $this->yudisiumRepository = $yudisiumRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
        $this->groupYudisiumRepository = $groupYudisiumRepository;
    }

    public function list(Request $request)
    {
        $yudisium = Yudisium::orderBy('created_at', 'DESC')->simplePaginate(20);
        $key = $request->get('key');
        $groupYudisium = $this->groupYudisiumRepository->findByIsActive();
        if ($key != null) {
            $yudisium = Yudisium::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->simplePaginate(20);
        }
        return view('yudisium.list', compact('yudisium', 'groupYudisium'));
    }

    public function formRegister($nim)
    {
        $ujianAkhir = UjianAkhir::where('is_verify', 1)->where('nim', $nim)->first();
        if ($ujianAkhir == null) {
            return view('pendaftaran.not-registered', ['message' => 'Anda belum dapat mendaftar Yudisium']);
        }
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $skripsi = $this->bimbinganSkripsiRepository->findByNim($nim);
        return view('yudisium.register', compact('mahasiswa', 'skripsi'));
    }

    public function register(YudisiumRegisterRequest $request)
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
            $result = $this->yudisiumService->register($request);
            $this->yudisiumService->addBuktiPembayaran($result->id, $fileBuktiPembayaran);
            $this->yudisiumService->addBebasSpp($result->id, $fileBebasSpp);
            $this->yudisiumService->addTranskripNilai($result->id, $fileTranskripNilai);
            $this->yudisiumService->addBebasPerpus($result->id, $fileBebasPerpus);
            $this->yudisiumService->addArtikel($result->id, $fileArtikel);
            $this->yudisiumService->addFileSkripsi($result->id, $fileSkripsi);
            $this->yudisiumService->addBebasPlagiasi($result->id, $fileBebasPlagiasi);
            $this->yudisiumService->addBuktiPenjilidan($result->id, $fileBuktiPenjilidan);
            $this->yudisiumService->addBuktiPegumpulan($result->id, $fileBuktiPengumpulan);
            return redirect()->route('yudisium.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (YudisiumIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }
    public function edit($nim)
    {

        $yudisium = $this->yudisiumRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('yudisium.edit', compact('yudisium', 'mahasiswa'));
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
            return redirect()->route('yudisium.detail', $yudisium->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $yudisium = $this->yudisiumRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($yudisium->nim);
        $groupYudisium = $this->groupYudisiumRepository->findByIsActive();

        return view('yudisium.detail', compact('yudisium', 'mahasiswa', 'groupYudisium'));
    }
}
