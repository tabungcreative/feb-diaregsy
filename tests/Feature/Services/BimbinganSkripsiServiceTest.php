<?php

namespace Tests\Feature\Services;

use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Models\TahunAjaran;
use App\Services\BimbinganSkripsiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BimbinganSkripsiServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private BimbinganSkripsiService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(BimbinganSkripsiService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new BimbinganSkripsiRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0002-10.22-SKP',
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('bimbinganskripsi', 1);
        $this->assertDatabaseHas('bimbinganskripsi', [
            'nim' => '2019150080',
            'no_pembayaran' => '0002-10.22-SKP',
        ]);
        $this->service->register($request);
    }
}
