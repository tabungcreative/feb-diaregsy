<?php
namespace App\Services;

use App\Http\Requests\GroupYudisiumAddRequest;
use App\Http\Requests\GroupYudisiumUpdateRequest;

interface GroupYudisiumService
{
    function add(GroupYudisiumAddRequest $request);
    function update(int $id, GroupYudisiumUpdateRequest $request);
    function active(int $id);
    function inActive(int $id);
    function destroy($id);
}
