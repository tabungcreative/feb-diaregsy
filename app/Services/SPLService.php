<?php

namespace App\Services;

use App\Http\Requests\SPLDafterRequest;

interface SPLService
{
    function daftar(SPLDafterRequest $request);
}
