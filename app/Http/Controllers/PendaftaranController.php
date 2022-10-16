<?php

namespace App\Http\Controllers;

use App\Exceptions\MahasiswaNotFoundException;
use App\Http\Requests\PendaftaranCekNimRequest;
use App\Services\MahasiswaService;
use Exception;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    private MahasiswaService $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->mahasiswaService = $mahasiswaService;
    }
    public function formCekNim()
    {
        return view('pendaftaran.cek-nim');
    }

    public function cekNim(PendaftaranCekNimRequest $request)
    {
        try {
            $nim = $request->input('nim');

            $this->mahasiswaService->checkMahasiswa($nim);

            return redirect()->route('pendaftaran.list', $nim)->with('success', 'Mahasiswa telah terdaftar');
        } catch (MahasiswaNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        } catch (Exception $e) {
            abort(500, 'Terjadi kesalahan pada server');
        }
    }

    public function list($nim)
    {
        return view('pendaftaran.list', compact('nim'));
    }
}
