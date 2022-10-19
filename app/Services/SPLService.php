<?php

namespace App\Services;

use App\Http\Requests\SPLCreateMessageRequest;
use App\Http\Requests\SPLRegisterRequest;
use App\Http\Requests\SPLUpdateRequest;

interface SPLService
{
    function register(SPLRegisterRequest $request);
    function addKtp(int $id, $fileKtp);
    function verify(int $id);
    function createMessage(int $id, SPLCreateMessageRequest $request);
    function update(int $id, SPLUpdateRequest $request);
}
