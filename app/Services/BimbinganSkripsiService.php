<?php

namespace App\Services;

use App\Http\Requests\BimbinganSkripsiCreateMessageRequest;
use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Http\Requests\BimbinganSkripsiUpdateRequest;

interface BimbinganSkripsiService
{
    function register(BimbinganSkripsiRegisterRequest $request);
    function verify(int $id);
    function createMessage(int $id, BimbinganSkripsiCreateMessageRequest $request);
    function update(int $id, BimbinganSkripsiUpdateRequest $request);
}
