<?php

namespace Tests\Feature\Services;

use App\Exceptions\MagangIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MagangCreateMessageRequest;
use App\Http\Requests\MagangRegisterRequest;
use App\Models\Magang;
use App\Models\TahunAjaran;
use App\Services\MagangService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class MagangServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private MagangService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(MagangService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new MagangRegisterRequest([
            'nim' => '2019150080',
            'alamat' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'no_pembayaran' => '0004-10.22-MGN',
            'instansi_magang' => $this->faker->word(10),
            'pimpinan_instansi' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'lembar_persetujuan' => null,
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('magang', 1);
        $this->assertDatabaseHas('magang', [
            'nim' => '2019150080',
            'no_pembayaran' => '0004-10.22-MGN',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new MagangRegisterRequest([
            'nim' => '2019150080',
            'alamat' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'no_pembayaran' => '0004-10.22-MGN',
            'instansi_magang' => $this->faker->word(10),
            'pimpinan_instansi' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'lembar_persetujuan' => null,
        ]);

        $this->service->register($request);
    }

    public function testRegisterIsExist()
    {
        $this->expectErrorMessage('anda sudah pernah mendaftar magang');
        $this->expectException(MagangIsExistException::class);
        TahunAjaran::factory()->create(['is_active' => 1]);
        Magang::factory()->create(['nim' => '2019150080']);

        $request = new MagangRegisterRequest([
            'nim' => '2019150080',
            'alamat' => $this->faker->word(10),
            'email' => $this->faker->email(),
            'no_pembayaran' => '0004-10.22-MGN',
            'instansi_magang' => $this->faker->word(10),
            'pimpinan_instansi' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'lembar_persetujuan' => null,
        ]);

        $this->service->register($request);
    }

    public function testVerify()
    {
        $magang = Magang::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('magang', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($magang->id);

        $this->assertDatabaseHas('magang', [
            'is_verify' => 1
        ]);
    }

    public function testCreateMessage()
    {
        $magang = Magang::factory()->create(['keterangan' => 'old message']);

        $request = new MagangCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('magang', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($magang->id, $request);

        $this->assertDatabaseHas('magang', [
            'keterangan' => 'new message'
        ]);
    }
}
