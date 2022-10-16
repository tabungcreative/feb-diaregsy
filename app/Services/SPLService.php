<?php

namespace App\Services;

use App\Http\Requests\SPLRegisterRequest;

interface SPLService
{
    function register(SPLRegisterRequest $request);
    function addKtp(int $id, $fileKtp);
}
