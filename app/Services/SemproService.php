<?php

namespace App\Services;

use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;

interface SemproService
{
    function register(SemproRegisterRequest $request);
    function addKtp(int $id, $fileKtp);
    function verify(int $id);
    function createMessage(int $id, SemproCreateMessageRequest $request);
    function update(int $id, SemproUpdateRequest $request);
}
