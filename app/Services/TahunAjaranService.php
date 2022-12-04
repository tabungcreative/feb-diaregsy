<?php

namespace App\Services;

use App\Http\Requests\TahunAjaran;
use App\Http\Requests\TahunAjaranUpdate;

interface TahunAjaranService
{
    function addTahunAjaran(TahunAjaran $request);
    function updateTahunAjaran(int $id, TahunAjaranUpdate $request);
    function deleteTahunAjaran(int $id);
    function active(int $id);
    function inActive(int $id);
}
