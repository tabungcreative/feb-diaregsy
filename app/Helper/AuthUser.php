<?php

namespace App\Helper;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthUser
{
    public static function user()
    {
        $token = session('access_token');

        if ($token == null) {
            return null;
        }

        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        return $jwtPayload->user;
    }

    public static function accessToken()
    {
        return Session::get('access_token');
    }
}
