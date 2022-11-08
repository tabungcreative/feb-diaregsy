<?php

namespace Tests\Feature\Services;

use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Http\Requests\SemproUpdateRequest;
use App\Models\Sempro;
use App\Models\TahunAjaran;
use App\Services\SemproService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SemproServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private SemproService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(SemproService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new SemproRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_sempro' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0011-11.22-SK',
            'nota_kaprodi' => null,
            'lembar_persetujuan' => null,
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('sempro', 1);
        $this->assertDatabaseHas('sempro', [
            'nim' => '2019150080',
            'no_pembayaran' => '0011-11.22-SK',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new SemproRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_sempro' => $this->faker->word(10),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0011-11.22-SK',
            'nota_kaprodi' => null,
            'lembar_persetujuan' => null,
        ]);

        $this->service->register($request);
    }

    public function testVerify()
    {
        $sempro = Sempro::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('sempro', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($sempro->id);

        $this->assertDatabaseHas('sempro', [
            'is_verify' => 1
        ]);
    }

    public function testCreateMessage()
    {
        $sempro = Sempro::factory()->create(['keterangan' => 'old message']);

        $request = new SemproCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('sempro', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($sempro->id, $request);

        $this->assertDatabaseHas('sempro', [
            'keterangan' => 'new message'
        ]);
    }

    public function testUpdate()
    {
        $sempro = Sempro::factory()->create(['nim' => '2019150080', 'no_pembayaran' => '0007-10.22-SK',]);

        $request = new SemproUpdateRequest([
            'email' => 'slamet@gmail.com',
            'judul_sempro' => 'lol',
            'no_whatsapp' => '2342343242',
        ]);

        $this->service->update($sempro->id, $request);

        $this->assertDatabaseHas('sempro', [
            'email' => 'slamet@gmail.com',
            'judul_sempro' => 'lol',
            'no_whatsapp' => '2342343242',
        ]);
        $this->assertDatabaseCount('sempro', 1);
    }
}
