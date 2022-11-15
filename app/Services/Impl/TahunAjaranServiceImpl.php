<?php

namespace App\Services\Impl;

use App\Http\Requests\TahunAjaran;
use App\Http\Requests\TahunAjaranUpdate;
use App\Repositories\TahunAjaranRepository;
use App\Services\TahunAjaranService;

class TahunAjaranServiceImpl implements TahunAjaranService
{

    private TahunAjaranRepository $tahunAjaranRepository;

    public function __construct(
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->tahunAjaranRepository = $tahunAjaranRepository;
    }
    function addTahunAjaran(TahunAjaran $request)
    {
        $tahun = $request->input('tahun');
        $semester = $request->input('semester');
    
        $detailTahunAjaran = [
            'tahun' => $tahun,
            'semester' => $semester,
        ];

        $tahunAjaran = $this->tahunAjaranRepository->create($detailTahunAjaran);

        return $tahunAjaran;
    }
    function updateTahunAjaran(int $id, TahunAjaranUpdate $request)
    {

        $tahun = $request->input('tahun');
        $semester = $request->input('semester');
    
        $detailTahunAjaran = [
            'tahun' => $tahun,
            'semester' => $semester,
        ];

        $tahunAjaran = $this->tahunAjaranRepository->update($id,$detailTahunAjaran);

        return $tahunAjaran;
    }
    function deleteTahunAjaran(int $id)
    {
        
    }

    function active(int $id)
    {
        $detailTahunAjaran = [
            'is_verify' => 1
        ];
        $tahunAjaran = $this->tahunAjaranRepository->update($id, $detailTahunAjaran);
        return $tahunAjaran;
    }
    
    function inActive(int $id)
    {
        $detailTahunAjaran = [
            'is_verify' => 0
        ];
        $tahunAjaran = $this->tahunAjaranRepository->update($id, $detailTahunAjaran);
        return $tahunAjaran;
    }

}