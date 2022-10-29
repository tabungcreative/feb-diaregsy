<?php

namespace Tests\Feature\Repositories;

use App\Models\TahunAjaran;
use App\Repositories\BimbinganSkripsiRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BimbinganSkripsiRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private BimbinganSkripsiRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(BimbinganSkripsiRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        $tahunAjaran = TahunAjaran::factory()->create();
        $detailBimbinganSkripsi = [
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0002-10.22-SKP',

        ];

        $this->repository->create($detailBimbinganSkripsi, $tahunAjaran->id);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseCount('bimbinganskripsi', 1);
    }
}
