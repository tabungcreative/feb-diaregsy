<?php

namespace App\Respositories\Api;

use App\Respositories\PembayaranRepository;
use Illuminate\Support\Facades\Http;

class PembayaranRepositoryApi implements PembayaranRepository
{

    private string $url;
    private string $apiKey;


    public function __construct()
    {
        $this->url = env('PEMBAYARAN_API_URL');
        $this->apiKey = env('PEMBAYARAN_API_KEY');
    }


    function findByNoPembayaran(string $noPembayaran)
    {
        $endpoint = $this->url . '/pembayaran/' . $noPembayaran . '/no-pembayaran';
        $response = Http::withHeaders([
            'api-key' => $this->apiKey
        ])->get($endpoint);

        if ($response->status() == 200) {
            $noPembayaran = json_decode($response->body(), true)['data'];
            return $noPembayaran;
        } else {
            return null;
        }
    }
}
