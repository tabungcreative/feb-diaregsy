<?php

namespace Tests\Feature\Services;

use App\Exceptions\MahasiswaNotFoundException;
use App\Exceptions\PembayaranNotFoundException;
use App\Exceptions\PembayaranNotSuitableWithNimException;
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
        $nim = '2019150080';

        $result = $this->service->checkPembayaran($nomerPembayaran, $nim);

        assertTrue($result);
    }

    public function testCheckPembayaranNoPembayaranNull()
    {
        $this->expectErrorMessage('pembayaran tidak ditemukan');
        $this->expectException(PembayaranNotFoundException::class);
        $nomerPembayaran = 'salah';
        $nim = 'salah';

        $this->service->checkPembayaran($nomerPembayaran, $nim);
    }

    public function testCheckPembayaranNimNull()
    {
        $this->expectErrorMessage('mahasiswa tidak ditemukan');
        $this->expectException(MahasiswaNotFoundException::class);
        $nomerPembayaran = '0001-10.22-SKP';
        $nim = 'salah';

        $this->service->checkPembayaran($nomerPembayaran, $nim);
    }

    public function testCheckPembayaranNotSuit()
    {
        $this->expectErrorMessage('Nim dan Nomer Pembayaran tidak sesui');
        $this->expectException(PembayaranNotSuitableWithNimException::class);
        $nomerPembayaran = '0001-10.22-SKP';
        $nim = '2019150081';

        $this->service->checkPembayaran($nomerPembayaran, $nim);
    }
}
