<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TahunAjaranRepository;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    //
    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }


    public function index()
    {
        $title = 'Tahun Ajaran';
        $tahunAjaran = $this->tahunAjaranRepository->getALl();
        return view('admin.tahunAjaran.index', compact('title', 'tahunAjaran'));
    }
}
