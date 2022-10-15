<?php

namespace Tests\Feature\Repositories;

use App\Respositories\PembayaranRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PembayaranRepositoryTest extends TestCase
{
    private PembayaranRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(PembayaranRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testFindByNomerPembayaranSuccess()
    {
        $nomerPembayaran = '0001-10.22-SKP';
        $result = $this->repository->findByNoPembayaran($nomerPembayaran);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('no_pembayaran', $result);
    }

    public function testFindByNomerPembayaranIsNull()
    {
        $nomerPembayaran = 'salah';
        $result = $this->repository->findByNoPembayaran($nomerPembayaran);

        $this->assertNull($result);
    }
}
