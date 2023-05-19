<?php

namespace App\Services;

use App\Http\Requests\KompreAddTanggalUjianRequest;
use App\Http\Requests\KompreCreateMessageRequest;
use App\Http\Requests\KompreRegisterRequest;
use App\Http\Requests\KompreUpdateRequest;
use App\Http\Requests\KompreUpdateStatusRequest;

interface KompreService
{
    function register(KompreRegisterRequest $request);
    function addBuktiPembayaran(int $id, $fileBuktiPembayaran);
    function verify(int $id);
    function createMessage(int $id, KompreCreateMessageRequest $request);
    function update(int $id, KompreUpdateRequest $request);
    function destroy($id);
    function changeStatus(int $id, KompreUpdateStatusRequest $request);
    function addTanggalUjian($id, KompreAddTanggalUjianRequest $request);
}
