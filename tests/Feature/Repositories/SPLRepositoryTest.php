<?php

namespace Tests\Feature\Repositories;

use App\Models\TahunAjaran;
use App\Repositories\SPLRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SPLRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private SPLRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(SPLRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        $detailSPL = [
            'nim' => '2019150080',
            'no_pembayaran' => '0001-10.22-SKP',
            'foto_ktp' => $this->faker->imageUrl(),
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
            'no_whatsapp' => $this->faker->phoneNumber

        ];

        $this->repository->create($detailSPL, $tahunAjaran->id);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseCount('spl', 1);
    }
}
