<?php

namespace App\Services;

use App\Http\Requests\MagangCreateMessageRequest;
use App\Http\Requests\MagangRegisterRequest;
use App\Http\Requests\MagangUpdateRequest;

interface MagangService
{
    function register(MagangRegisterRequest $request);
    function addLembarPersetujuan(int $id, $fileLembarPersetujuan);
    function verify(int $id);
    function createMessage(int $id, MagangCreateMessageRequest $request);
    function update(int $id, MagangUpdateRequest $request);
}
