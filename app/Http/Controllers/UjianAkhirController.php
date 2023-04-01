<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Exceptions\UjianAkhirIsExistException;
use App\Http\Requests\UjianAkhirRegisterRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Models\Kompre;
use App\Models\UjianAkhir;
use App\Repositories\BimbinganSkripsiRepository;
use App\Repositories\MahasiswaRepository;
use App\Repositories\UjianAkhirRepository;
use App\Services\UjianAkhirService;
use Exception;
use Illuminate\Http\Request;

class UjianAkhirController extends Controller
{
    //
    private UjianAkhirService $ujianAkhirService;
    private UjianAkhirRepository $ujianAkhirRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private BimbinganSkripsiRepository $bimbinganSkripsiRepository;

    public function __construct(UjianAkhirService $ujianAkhirService, UjianAkhirRepository $ujianAkhirRepository, MahasiswaRepository $mahasiswaRepository, BimbinganSkripsiRepository $bimbinganSkripsiRepository)
    {
        $this->ujianAkhirService = $ujianAkhirService;
        $this->ujianAkhirRepository = $ujianAkhirRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->bimbinganSkripsiRepository = $bimbinganSkripsiRepository;
    }

    public function list(Request $request)
    {
        $ujianAkhir = UjianAkhir::orderBy('created_at','DESC')->paginate(20);
        $key = $request->get('key');
        if ($key != null) {
            $ujianAkhir = UjianAkhir::where('nim', 'LIKE', "%" . $key ."%")
                ->orWhere('nama', 'LIKE', "%" . $key ."%")
                ->paginate(20);
        }
        return view('ujianAkhir.list', compact('ujianAkhir'));
    }

    public function formRegister($nim)
    {
        $kompre = Kompre::where('is_verify', 1)->where('nim', $nim)->first();
        if ($kompre == null) {
            return 'Anda belum dapat mendaftar Ujian Tugas Akhir';
        }
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
        $skripsi = $this->bimbinganSkripsiRepository->findByNim($nim);
        return view('ujianAkhir.register', compact('mahasiswa', 'skripsi'));
    }

    public function register(UjianAkhirRegisterRequest $request)
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
            $result = $this->ujianAkhirService->register($request);
            $this->ujianAkhirService->addBerkasSkripsi($result->id, $fileSkripsi);
            $this->ujianAkhirService->addIjazahTerakhir($result->id, $fileIjazahTerakhir);
            $this->ujianAkhirService->addTranskripNilai($result->id, $fileTranskripNilai);
            $this->ujianAkhirService->addAkta($result->id, $fileAkta);
            $this->ujianAkhirService->addKK($result->id, $fileKK);
            $this->ujianAkhirService->addKtp($result->id, $fileKtp);
            $this->ujianAkhirService->addLembarBimbingan($result->id, $fileLembarBimbingan);
            $this->ujianAkhirService->addSlipSemesterTerakhir($result->id, $fileSlipSemesterTerakhir);
            $this->ujianAkhirService->addPembayaranSkripsi($result->id, $filePembayaranSkripsi);
            $this->ujianAkhirService->addSertifikat($result->id, $fileSertifikat);
            return redirect()->route('ujianAkhir.detail', $result->id)->with('success', 'Berhasil melakukan pendaftaran');
        } catch (TahunAjaranIsNotFound $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (UjianAkhirIsExistException $e) {
            return redirect()->back()->with('update', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            dd($e);
            // abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function edit($nim)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findByNim($nim);
        $mahasiswa = $this->mahasiswaRepository->findByNim($nim);

        return view('ujianAkhir.edit', compact('ujianAkhir', 'mahasiswa'));
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
            return redirect()->route('ujianAkhir.detail', $ujianAkhir->id)->with('success', 'Berhasil mengubah data pendaftaran');
        } catch (Exception $exception) {
            abort(500, 'terjadi kesalahan pada server');
        }
    }

    public function detail($id)
    {
        $ujianAkhir = $this->ujianAkhirRepository->findById($id);
        $mahasiswa = $this->mahasiswaRepository->findByNim($ujianAkhir->nim);
        return view('ujianAkhir.detail', compact('ujianAkhir', 'mahasiswa'));
    }
}
