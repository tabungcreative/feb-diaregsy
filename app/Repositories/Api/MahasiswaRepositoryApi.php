<?php

namespace App\Repositories\Api;

use App\Repositories\MahasiswaRepository;
use Illuminate\Support\Facades\Http;

class MahasiswaRepositoryApi implements MahasiswaRepository
{
    private string $url;

    public function __construct()
    {
        $this->url = env('MAHASISWA_API_URL');
    }

    function findByNim(string $nim)
    {
        $endpoint = $this->url . '/mahasiswa/' . $nim;
        $response = Http::get($endpoint);

        if ($response->status() == 200) {
            $noPembayaran = json_decode($response->body(), true)['data'];
            return $noPembayaran;
        } else {
            return null;
        }
    }
}
