<?php

namespace App\Services;

use App\Http\Requests\SPLCreateMessageRequest;
use App\Http\Requests\SPLRegisterRequest;

interface SPLService
{
    function register(SPLRegisterRequest $request);
    function addKtp(int $id, $fileKtp);
    function verify(int $id);
    function createMessage(int $id, SPLCreateMessageRequest $request);
}
