<?php

namespace App\Services;

use App\Http\Requests\MengulangCreateMessageRequest;
use App\Http\Requests\MengulangRegisterRequest;
use App\Http\Requests\MengulangUpdateRequest;

interface MengulangService
{
    function register(MengulangRegisterRequest $request);
    function addKhs(int $id, $fileKhs);
    function addBuktiPembayaran(int $id, $fileBuktiPembayaran);
    function verify(int $id);
    function createMessage(int $id, MengulangCreateMessageRequest $request);
    function update(int $id, MengulangUpdateRequest $request);
}