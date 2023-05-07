<?php

namespace App\Services\Impl;

use App\Http\Requests\TahunAjaran;
use App\Http\Requests\TahunAjaranUpdate;
use App\Http\Requests\TahunAjaranUpdateRequest;
use App\Repositories\TahunAjaranRepository;
use App\Services\TahunAjaranService;
use Illuminate\Support\Facades\DB;

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
    function updateTahunAjaran(int $id, TahunAjaranUpdateRequest $request)
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
        try {
            DB::beginTransaction();
            // inactive all record
            $this->tahunAjaranRepository->updateIsActiveAll(0);
            // make tahun ajaran active
            $tahunAjaran = $this->tahunAjaranRepository->update($id, [
                'is_active' => 1
            ]);

            DB::commit();
            return $tahunAjaran;
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }

    }

    function inActive(int $id)
    {
        $detailTahunAjaran = [
            'is_active' => 0
        ];
        $tahunAjaran = $this->tahunAjaranRepository->update($id, $detailTahunAjaran);
        return $tahunAjaran;
    }

    function destroy($id)
    {
        $spl = $this->tahunAjaranRepository->findById($id);

        $this->tahunAjaranRepository->delete($id);
    }
}
