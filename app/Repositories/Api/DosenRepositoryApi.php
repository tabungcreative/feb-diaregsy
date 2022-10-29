<?php

namespace App\Repositories\Api;

use App\Repositories\DosenRepository;
use Illuminate\Support\Facades\Http;

class DosenRepositoryApi implements DosenRepository
{

    private string $url;

    public function __construct()
    {
        $this->url = env('MAHASISWA_API_URL');
    }

    function getAllDosen()
    {
        $endpoint = $this->url . '/dosen/';
        $response = Http::get($endpoint);
        $obj = json_decode($response->getBody(), true)['data'];

        return $obj;
    }
}
