<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjaran;
use App\Repositories\TahunAjaranRepository;
use App\Services\TahunAjaranService;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    //
    private TahunAjaranRepository $tahunAjaranRepository;
    private TahunAjaranService $tahunAjaranService;

    public function __construct(
        TahunAjaranService $tahunAjaranService,
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->tahunAjaranRepository = $tahunAjaranRepository;
        $this->tahunAjaranService = $tahunAjaranService;
    }


    public function index()
    {
        $title = 'Tahun Ajaran';
        $tahunAjaran = $this->tahunAjaranRepository->getALl();
        return view('admin.tahunAjaran.index', compact('title', 'tahunAjaran'));
    }

    public function store(TahunAjaran $request)
    {
        try {
            $tahunAjaran = $this->tahunAjaranService->addTahunAjaran($request);
            return redirect()->back()->with('success', 'Berhasil menambahkan tahun ajaran');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }

    public function active($id)
    {
        try {
            $this->tahunAjaranService->active($id);
            return redirect()->back()->with('success', 'Tahun Ajaran Berhasil diaktifkan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function inActive($id)
    {
        try {
            $this->tahunAjaranService->inActive($id);
            return redirect()->back()->with('success', 'Tahun Ajaran Berhasil di non aktifkan');
        } catch (\Exception $exception) {
            abort(500, 'Terjadi masalah pada server');
        }
    }
}
