<?php

namespace Tests\Feature\Repositories;

use App\Respositories\MahasiswaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MahasiswaRepositoryTest extends TestCase
{
    private MahasiswaRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(MahasiswaRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testFindByNimSuccess()
    {
        $nomerPembayaran = '2019150080';
        $result = $this->repository->findByNim($nomerPembayaran);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('nim', $result);
    }

    public function testFindByNimIsNull()
    {
        $nomerPembayaran = 'salah';
        $result = $this->repository->findByNim($nomerPembayaran);

        $this->assertNull($result);
    }
}
