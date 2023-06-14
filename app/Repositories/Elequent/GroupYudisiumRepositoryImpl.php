<?php
namespace App\Repositories\Elequent;

use App\Models\GroupYudisium;
use App\Repositories\GroupYudisiumRepository;
use Illuminate\Support\Facades\DB;

class GroupYudisiumRepositoryImpl implements GroupYudisiumRepository {
    function getALl()
    {
        return GroupYudisium::orderBy('created_at', 'DESC')->get();
    }

    function create(array $detail): GroupYudisium
    {
        $groupYudisium = new GroupYudisium($detail);
        $groupYudisium->save();
        return $groupYudisium;
    }

    function findByIsActive(): ?GroupYudisium
    {
        return GroupYudisium::where('is_active', 1)->first();
    }

    function update(int $id, $detail): GroupYudisium
    {
        $groupYudisium  = GroupYudisium::find($id);
        $groupYudisium->update($detail);
        $groupYudisium->save();
        return $groupYudisium;
    }

    function updateNotActive(): void
    {
        GroupYudisium::all()->update(['is_active' => 0]);
    }

    function updateIsActiveAll($isActive)
    {
        DB::table('group_yudisium')->update(['is_active' => $isActive]);
    }

    function findById($id)
    {
        GroupYudisium::find($id);
    }

    function delete($id)
    {
        return GroupYudisium::where('id', $id)->delete();
    }
}
