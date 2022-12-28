<?php

namespace App\Http\Controllers;

use App\Helper\AuthUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $redirectCallbak = 'admin/dashboard';

    public function login(Request $request)
    {
        $state = Str::random(40);
        $request->session()->put("state", $state);
        $query = http_build_query([
            'client_id' => env('CLIENT_ID'),
            'redirect_uri' => env('REDIRECT_AUTH_URI'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);
        return redirect(env('URL_OAUTH') . '/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        $state = $request->get('state');

        throw_unless(strlen($state) > 0 && $state == $request->state, InvalidArgumentException::class);

        $response = Http::asForm()->post(
            env('URL_OAUTH') . '/oauth/token',
            [
                'grant_type' => 'authorization_code',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'redirect_uri' => env('REDIRECT_AUTH_URI'),
                'code' => $request->code
            ]
        );
        $request->session()->put($response->json());

        $authUser = AuthUser::user();

        $user = new User();
        $user->name = $authUser->name;
        $user->email = $authUser->email;

        Auth::login($user);

        return redirect($this->redirectCallbak);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('access_token');
        return redirect('https://accounts.feb-unsiq.ac.id/logout');
    }
}
