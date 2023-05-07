<?php

namespace App\Services;

use App\Http\Requests\TahunAjaran;
use App\Http\Requests\TahunAjaranUpdate;
use App\Http\Requests\TahunAjaranUpdateRequest;

interface TahunAjaranService
{
    function addTahunAjaran(TahunAjaran $request);
    function updateTahunAjaran(int $id, TahunAjaranUpdateRequest $request);
    function deleteTahunAjaran(int $id);
    function active(int $id);
    function inActive(int $id);
    function destroy($id);
}
