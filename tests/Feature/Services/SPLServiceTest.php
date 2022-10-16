<?php

namespace Tests\Feature\Services;

use App\Exceptions\SPLIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SPLCreateMessageRequest;
use App\Http\Requests\SPLRegisterRequest;
use App\Models\SPL;
use App\Models\TahunAjaran;
use App\Services\SPLService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SPLServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private SPLService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(SPLService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new SPLRegisterRequest([
            'nim' => '2019150080',
            'foto_ktp' => null,
            'no_pembayaran' => '0001-10.22-SKP',
            'no_whatsapp' => $this->faker->phoneNumber(),
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('spl', 1);
        $this->assertDatabaseHas('spl', [
            'nim' => '2019150080',
            'no_pembayaran' => '0001-10.22-SKP',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new SPLRegisterRequest([
            'nim' => '2019150080',
            'foto_ktp' => null,
            'no_pembayaran' => '0001-10.22-SKP',
            'no_whatsapp' => $this->faker->phoneNumber(),
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
        ]);

        $this->service->register($request);
    }

    public function testRegisterIsExist()
    {
        $this->expectErrorMessage('anda sudah pernah mendaftar SPL');
        $this->expectException(SPLIsExistsException::class);
        TahunAjaran::factory()->create(['is_active' => 1]);
        SPL::factory()->create(['nim' => '2019150080']);

        $request = new SPLRegisterRequest([
            'nim' => '2019150080',
            'foto_ktp' => null,
            'no_pembayaran' => '0001-10.22-SKP',
            'no_whatsapp' => $this->faker->phoneNumber(),
            'jenis_pendaftaran' => Arr::random(['kip', 'reguler']),
        ]);

        $this->service->register($request);
    }

    public function testVerify()
    {
        $spl = SPL::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('spl', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($spl->id);

        $this->assertDatabaseHas('spl', [
            'is_verify' => 1
        ]);
    }

    public function testCreateMessage()
    {
        $spl = SPL::factory()->create(['keterangan' => 'old message']);

        $request = new SPLCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('spl', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($spl->id, $request);

        $this->assertDatabaseHas('spl', [
            'keterangan' => 'new message'
        ]);
    }
}
