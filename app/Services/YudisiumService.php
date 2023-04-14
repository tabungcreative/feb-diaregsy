<?php

namespace App\Services;

use App\Http\Requests\YudisiumCreateMessageRequest;
use App\Http\Requests\YudisiumRegisterRequest;
use App\Http\Requests\YudisiumUpdateRequest;

interface YudisiumService
{
    function register(YudisiumRegisterRequest $request);
    function verify(int $id);
    function createMessage(int $id, YudisiumCreateMessageRequest $request);
    function update(int $id, YudisiumUpdateRequest $request);
    function addBuktiPembayaran(int $id, $fileBuktiPembayaran);
    function addBebasSpp(int $id, $fileBebasSpp);
    function addTranskripNilai(int $id, $fileTranskripNilai);
    function addBebasPerpus(int $id, $fileBebasPerpus);
    function addArtikel(int $id, $fileArtikel);
    function addFileSkripsi(int $id, $fileSkripsi);
    function addBebasPlagiasi(int $id, $fileBebasPlagiasi);
    function addBuktiPenjilidan(int $id, $fileBuktiPenjilidan);
    function addBuktiPegumpulan(int $id, $fileBuktiPengumpulan);
    function destroy($id);
}
