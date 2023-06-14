<?php
namespace App\Services\Impl;

use App\Http\Requests\GroupYudisiumAddRequest;
use App\Http\Requests\GroupYudisiumUpdateRequest;
use App\Repositories\GroupYudisiumRepository;
use App\Services\GroupYudisiumService;
use Illuminate\Support\Facades\DB;

class GroupYudisiumServiceImpl implements GroupYudisiumService {

    private GroupYudisiumRepository $groupYudisisumRepository;

    public function __construct(
        GroupYudisiumRepository $groupYudisisumRepository
    ) {
        $this->groupYudisisumRepository = $groupYudisisumRepository;
    }

    function add(GroupYudisiumAddRequest $request)
    {
        $nama = $request->input('nama');
        $link = $request->input('link');

        $detail = [
            'nama' => $nama,
            'link' => $link,
        ];

        $groupYudisium = $this->groupYudisisumRepository->create($detail);
        return $groupYudisium;
    }

    function update(int $id, GroupYudisiumUpdateRequest $request)
    {
        $nama = $request->input('nama');
        $link = $request->input('link');

        $detail = [
            'nama' => $nama,
            'link' => $link,
        ];

        $groupYudisium = $this->groupYudisisumRepository->update($id,$detail);

        return $groupYudisium;
    }

    function active(int $id)
    {
        try {
            DB::beginTransaction();
            // inactive all record
            $this->groupYudisisumRepository->updateIsActiveAll(0);
            // make tahun ajaran active
            $groupYudisium = $this->groupYudisisumRepository->update($id, [
                'is_active' => 1
            ]);

            DB::commit();
            return $groupYudisium;
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    function inActive(int $id)
    {
        $detail = [
            'is_active' => 0
        ];
        $groupYudisium = $this->groupYudisisumRepository->update($id, $detail);
        return $groupYudisium;
    }

    function destroy($id)
    {
        $this->groupYudisisumRepository->findById($id);
        $this->groupYudisisumRepository->delete($id);
    }
}
