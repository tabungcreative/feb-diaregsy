<?php

namespace Tests\Feature\Services;

use App\Exceptions\PembayaranNotFoundException;
use App\Services\PembayaranService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class PembayaranServiceTest extends TestCase
{
    private PembayaranService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(PembayaranService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testCheckPembayaranSuccess()
    {
        $nomerPembayaran = '0001-10.22-SKP';

        $result = $this->service->checkPembayaran($nomerPembayaran);

        assertTrue($result);
    }

    public function testCheckPembayaranFail()
    {
        $this->expectErrorMessage('pembayaran tidak ditemukan');
        $this->expectException(PembayaranNotFoundException::class);
        $nomerPembayaran = 'salah';

        $this->service->checkPembayaran($nomerPembayaran);
    }
}
