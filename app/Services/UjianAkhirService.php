<?php

namespace App\Services;

use App\Http\Requests\UjianAkhirAddTanggalUjianRequest;
use App\Http\Requests\UjianAkhirCreateMessageRequest;
use App\Http\Requests\UjianAkhirRegisterRequest;
use App\Http\Requests\UjianAkhirUpdateRequest;
use App\Http\Requests\UjianAkhirUpdateStatusRequest;

interface UjianAkhirService
{
    function register(UjianAkhirRegisterRequest $request);
    function addBerkasSkripsi(int $id, $fileSkripsi);
    function addIjazahTerakhir(int $id, $fileIjazahTerakhir);
    function addTranskripNilai(int $id, $fileTranskripNilai);
    function addAkta(int $id, $fileAkta);
    function addKK(int $id, $fileKK);
    function addKtp(int $id, $fileKtp);
    function addLembarBimbingan(int $id, $fileLembarBimbingan);
    function addSlipSemesterTerakhir(int $id, $fileSlipSemesterTerakhir);
    function addPembayaranSkripsi(int $id, $filePembayaranSkripsi);
    function addSertifikat(int $id, $fileSertifikat);
    function verify(int $id);
    function createMessage(int $id, UjianAkhirCreateMessageRequest $request);
    function update(int $id, UjianAkhirUpdateRequest $request);
    function destroy($id);
    function changeStatus(int $id, UjianAkhirUpdateStatusRequest $request);
    function addTanggalUjian($id, UjianAkhirAddTanggalUjianRequest $request);
}
