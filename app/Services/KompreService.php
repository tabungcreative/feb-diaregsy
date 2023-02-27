<?php

namespace App\Services;

use App\Http\Requests\KompreCreateMessageRequest;
use App\Http\Requests\KompreRegisterRequest;
use App\Http\Requests\KompreUpdateRequest;

interface KompreService
{
    function register(KompreRegisterRequest $request);
    function addBuktiPembayaran(int $id, $fileBuktiPembayaran);
    function verify(int $id);
    function createMessage(int $id, KompreCreateMessageRequest $request);
    function update(int $id, KompreUpdateRequest $request);
}
