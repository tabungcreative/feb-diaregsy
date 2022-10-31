<?php

namespace Tests\Feature\Services;

use App\Exceptions\BimbinganSkripsiIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\BimbinganSkripsiCreateMessageRequest;
use App\Http\Requests\BimbinganSkripsiRegisterRequest;
use App\Http\Requests\BimbinganSkripsiUpdateRequest;
use App\Models\BimbinganSkripsi;
use App\Models\TahunAjaran;
use App\Services\BimbinganSkripsiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BimbinganSkripsiServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private BimbinganSkripsiService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(BimbinganSkripsiService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);

        $request = new BimbinganSkripsiRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0007-10.22-SK',
        ]);


        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('bimbinganskripsi', 1);
        $this->assertDatabaseHas('bimbinganskripsi', [
            'nim' => '2019150080',
            'no_pembayaran' => '0007-10.22-SK',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new BimbinganSkripsiRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0007-10.22-SK',
        ]);

        $this->service->register($request);
    }

    public function testRegisterIsExist()
    {
        $this->expectErrorMessage('anda sudah pernah mendaftar bimbingan skripsi');
        $this->expectException(BimbinganSkripsiIsExistException::class);
        TahunAjaran::factory()->create(['is_active' => 1]);
        BimbinganSkripsi::factory()->create(['nim' => '2019150080']);

        $request = new BimbinganSkripsiRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'judul_skripsi' => $this->faker->word(),
            'pembimbing1' => $this->faker->word(),
            'pembimbing2' => $this->faker->word(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0007-10.22-SK',
        ]);

        $this->service->register($request);
    }

    public function testVerify()
    {
        $bimbinganSkripsi = BimbinganSkripsi::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('bimbinganskripsi', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($bimbinganSkripsi->id);

        $this->assertDatabaseHas('bimbinganskripsi', [
            'is_verify' => 1
        ]);
    }

    public function testCreateMessage()
    {
        $bimbinganSkripsi = BimbinganSkripsi::factory()->create(['keterangan' => 'old message']);

        $request = new BimbinganSkripsiCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('bimbinganskripsi', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($bimbinganSkripsi->id, $request);

        $this->assertDatabaseHas('bimbinganskripsi', [
            'keterangan' => 'new message'
        ]);
    }

    public function testUpdate()
    {
        $bimbinganskripsi = BimbinganSkripsi::factory()->create(['nim' => '2019150080', 'no_pembayaran' => '0007-10.22-SK',]);

        $request = new BimbinganSkripsiUpdateRequest([
            'email' => 'slamet@gmail.com',
            'judul_skripsi' => 'slamet',
            'pembimbing1' => 'sangirun',
            'pembimbing2' => 'sangirun',
            'no_whatsapp' => '081233123123',
        ]);

        $this->service->update($bimbinganskripsi->id, $request);

        $this->assertDatabaseHas('bimbinganskripsi', [
            'email' => 'slamet@gmail.com',
            'judul_skripsi' => 'slamet',
            'pembimbing1' => 'sangirun',
            'pembimbing2' => 'sangirun',
            'no_whatsapp' => '081233123123',
        ]);
        $this->assertDatabaseCount('bimbinganskripsi', 1);
    }
}
