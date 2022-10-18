<?php

namespace App\Services;

use App\Http\Requests\MagangCreateMessageRequest;
use App\Http\Requests\MagangRegisterRequest;

interface MagangService
{
    function register(MagangRegisterRequest $request);
    function addLembarPersetujuan(int $id, $fileLembarPersetujuan);
    function verify(int $id);
    function createMessage(int $id, MagangCreateMessageRequest $request);
}
