<?php

namespace Tests\Feature\Services;

use App\Exceptions\SemproIsExistsException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\SemproCreateMessageRequest;
use App\Http\Requests\SemproRegisterRequest;
use App\Models\Sempro;
use App\Models\TahunAjaran;
use App\Services\SemproService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SemproServicesTest extends TestCase
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
            'no_pembayaran' => '0001-10.22-SPL',
            'judul' => $this->faker->title,
            'email' => $this->faker->email(),
            'no_hp' => $this->faker->phoneNumber(),
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('sempro', 1);
        $this->assertDatabaseHas('sempro', [
            'nim' => '2019150080',
            'no_pembayaran' => '0001-10.22-SPL',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new SemproRegisterRequest([
            'nim' => '2019150080',
            'no_pembayaran' => '0001-10.22-SPL',
            'judul' => $this->faker->title,
            'email' => $this->faker->email(),
            'no_hp' => $this->faker->phoneNumber(),
        ]);

        $this->service->register($request);
    }

    public function testRegisterIsExist()
    {
        $this->expectErrorMessage('anda sudah pernah mendaftar Seminar Proposal');
        $this->expectException(SemproIsExistsException::class);
        TahunAjaran::factory()->create(['is_active' => 1]);
        Sempro::factory()->create(['nim' => '2019150080']);

        $request = new SemproRegisterRequest([
            'nim' => '2019150080',
            'no_pembayaran' => '0001-10.22-SPL',
            'judul' => $this->faker->title,
            'email' => $this->faker->email(),
            'no_hp' => $this->faker->phoneNumber(),
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
        $spl = Sempro::factory()->create(['keterangan' => 'old message']);

        $request = new SemproCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('sempro', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($spl->id, $request);

        $this->assertDatabaseHas('sempro', [
            'keterangan' => 'new message'
        ]);
    }

    public function testUpdate() {
        self::markTestSkipped('skip');
        $spl = Sempro::factory()->create();

        $request = new SPLUpdateRequest([
            'no_whatsapp' => 'test',
            'jenis_pendaftaran' => 'reguler',
        ]);

        $this->service->update($spl->id, $request);

        $this->assertDatabaseHas('spl', [
            'no_whatsapp' => 'test',
            'jenis_pendaftaran' => 'reguler',
        ]);
        $this->assertDatabaseCount('spl', 1);
    }
}
