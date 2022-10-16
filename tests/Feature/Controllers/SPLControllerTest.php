<?php

namespace Tests\Feature\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SPLControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);

        $response = $this->post(route('spl.register'), [
            'nim' => '2019150080',
            'foto_ktp' => UploadedFile::fake()->create('test.pdf'),
            'no_pembayaran' => '0001-10.22-SKP',
            'no_whatsapp' => '08515538888',
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseCount('spl', 1);
    }
}
