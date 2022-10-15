<?php

namespace Tests\Feature\Repositories;

use App\Respositories\PembayaranRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertArrayHasKey;

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

    public function test_find_by_no()
    {
        $nomerPembayaran = '0001-10.22-SKP';
        $result = $this->repository->findByNoPembayaran($nomerPembayaran);

        assertArrayHasKey('id', $result);
        assertArrayHasKey('no_pembayaran', $result);
    }
}
