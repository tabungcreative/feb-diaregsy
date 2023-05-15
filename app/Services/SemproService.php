<?php

namespace App\Services;

use App\Http\Requests\SemproAddTanggalSeminarRequest;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Http\Requests\SemproUpdateStatusRequest;

interface SemproService
{
    function register(SemproRegisterRequest $request);
    function addNotaKaprodi(int $id, $fileNotaKaprodi);
    function addBerkasSempro(int $id, $fileBerkasSempro);
    function addBuktiPembayaran(int $id, $fileBuktiPembayaran);
    function verify(int $id);
    function createMessage(int $id, SemproCreateMessageRequest $request);
    function update(int $id, SemproUpdateRequest $request);
    function changeStatus(int $id, SemproUpdateStatusRequest $request);
    function destroy($id);
    function addTanggalSeminar($id, SemproAddTanggalSeminarRequest $request);
}
