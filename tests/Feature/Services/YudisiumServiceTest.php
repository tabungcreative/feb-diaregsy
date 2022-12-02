<?php

namespace Tests\Feature\Services;

use App\Http\Requests\YudisiumRegisterRequest;
use App\Models\TahunAjaran;
use App\Services\YudisiumService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class YudisiumServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private YudisiumService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(YudisiumService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new YudisiumRegisterRequest([
            'nim' => '2019150080',
            'judul_skripsi' => $this->faker->word(),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_ujian' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'ukuran_toga' => $this->faker->word(),
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('yudisium', 1);
        $this->assertDatabaseHas('yudisium', [
            'nim' => '2019150080',
        ]);
    }
}
