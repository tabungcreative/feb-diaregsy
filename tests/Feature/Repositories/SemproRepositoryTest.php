<?php

namespace Tests\Feature\Repositories;

use App\Models\TahunAjaran;
use App\Repositories\SemproRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SemproRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private SemproRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(SemproRepository::class);
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
            'nama' => 'Ahmad Rifai',
            'prodi' => 'Akuntansi',
            'no_pembayaran' => '0001-10.22-SKP',
            'judul' => 'judul',
            'email' => 'mail@mail.com',
            'no_hp' => 'judul',
            'berkas_seminar' => $this->faker->imageUrl(),
            'nota_dinas_kaprodi' => $this->faker->imageUrl(),
        ];

        $this->repository->create($detailSPL, $tahunAjaran->id);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseCount('sempro', 1);
    }
}
