<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjaran as TahunAjaranRequest;
use App\Http\Requests\TahunAjaranUpdateRequest;
use App\Models\TahunAjaran;
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
        $tahunAjaran = TahunAjaran::paginate(10);
        return view('admin.tahunAjaran.index', compact('title', 'tahunAjaran'));
    }

    public function store(TahunAjaranRequest $request)
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

    public function edit($id) {
        $title = 'Edit Tahun Ajaran';
        $tahunAjaran = TahunAjaran::find($id);
        return view('admin.tahunAjaran.edit', compact('title', 'tahunAjaran'));
    }

    public function update(TahunAjaranUpdateRequest $request, $id){
        try {
            $this->tahunAjaranService->updateTahunAjaran($id, $request);
            return back()->with('success', 'Berhasil mengubah tahun ajaran');
        } catch (\Exception $th) {
            abort(500, 'Terjadi masalah pada server');
        }
    }

    public function delete($id){
        try {
            $this->tahunAjaranService->destroy($id);
            return redirect()->back()->with('success', 'Berhasil menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus tahun ajaran, karena sudah terdapat mahasiswa terdaftar');
        }
    }
}
