<?php

namespace Tests\Feature\Services;

use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\KompreCreateMessageRequest;
use App\Http\Requests\KompreRegisterRequest;
use App\Http\Requests\KompreUpdateRequest;
use App\Models\Kompre;
use App\Models\TahunAjaran;
use App\Services\KompreService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KompreServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private KompreService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(KompreService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new KompreRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),

        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('kompre', 1);
        $this->assertDatabaseHas('kompre', [
            'nim' => '2019150080',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new KompreRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
        ]);
        $this->service->register($request);
    }

    public function testVerify()
    {
        $kompre = Kompre::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('kompre', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($kompre->id);

        $this->assertDatabaseHas('kompre', [
            'is_verify' => 1
        ]);
    }


    public function testCreateMessage()
    {
        $kompre = Kompre::factory()->create(['keterangan' => 'old message']);

        $request = new KompreCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('kompre', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($kompre->id, $request);

        $this->assertDatabaseHas('kompre', [
            'keterangan' => 'new message'
        ]);
    }

    public function testUpdate()
    {
        $kompre = Kompre::factory()->create(['nim' => '2019150080']);

        $request = new KompreUpdateRequest([
            'email' => 'slamet@gmail.com',
            'no_whatsapp' => '2342343242',
            'pembimbing1' => 'lol',
            'pembimbing2' => 'lol',
        ]);

        $this->service->update($kompre->id, $request);

        $this->assertDatabaseHas('kompre', [
            'email' => 'slamet@gmail.com',
            'no_whatsapp' => '2342343242',
            'pembimbing1' => 'lol',
            'pembimbing2' => 'lol',
        ]);
        $this->assertDatabaseCount('kompre', 1);
    }
}
