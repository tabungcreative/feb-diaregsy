<?php

namespace Tests\Feature\Services;

use App\Exceptions\MengulangIsExistException;
use App\Exceptions\TahunAjaranIsNotFound;
use App\Http\Requests\MengulangCreateMessageRequest;
use App\Http\Requests\MengulangRegisterRequest;
use App\Http\Requests\MengulangUpdateRequest;
use App\Models\Mengulang;
use App\Models\TahunAjaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\MengulangService;
use Tests\TestCase;

class MengulangServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private MengulangService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(MengulangService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testRegisterSuccess()
    {
        TahunAjaran::factory()->create(['is_active' => 1]);
        $request = new MengulangRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0013-11.22-SK',
            'khs' => null,
        ]);

        $this->service->register($request);

        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1,
        ]);
        $this->assertDatabaseCount('mengulang', 1);
        $this->assertDatabaseHas('mengulang', [
            'nim' => '2019150080',
            'no_pembayaran' => '0013-11.22-SK',
        ]);
    }

    public function testRegisterTahunAjaranNotFound()
    {
        $this->expectErrorMessage('tahun ajaran belum ditentukan');
        $this->expectException(TahunAjaranIsNotFound::class);
        $request = new MengulangRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0013-11.22-SK',
            'khs' => null,
        ]);

        $this->service->register($request);
    }

    public function testRegisterIsExist()
    {
        $this->expectErrorMessage('anda sudah pernah mendaftar mengulang');
        $this->expectException(MengulangIsExistException::class);
        TahunAjaran::factory()->create(['is_active' => 1]);
        Mengulang::factory()->create(['nim' => '2019150080']);

        $request = new MengulangRegisterRequest([
            'nim' => '2019150080',
            'email' => $this->faker->email(),
            'no_whatsapp' => $this->faker->phoneNumber(),
            'no_pembayaran' => '0013-11.22-SK',
            'khs' => null,
        ]);

        $this->service->register($request);
    }


    public function testVerify()
    {
        $mengulang = Mengulang::factory()->create(['is_verify' => 0]);

        $this->assertDatabaseHas('mengulang', [
            'is_verify' => 0
        ]);

        $result = $this->service->verify($mengulang->id);

        $this->assertDatabaseHas('mengulang', [
            'is_verify' => 1
        ]);
    }

    public function testCreateMessage()
    {
        $mengulang = Mengulang::factory()->create(['keterangan' => 'old message']);

        $request = new MengulangCreateMessageRequest([
            'pesan' => 'new message'
        ]);

        $this->assertDatabaseHas('mengulang', [
            'keterangan' => 'old message'
        ]);

        $this->service->createMessage($mengulang->id, $request);

        $this->assertDatabaseHas('mengulang', [
            'keterangan' => 'new message'
        ]);
    }

    public function testUpdate()
    {
        $mengulang = Mengulang::factory()->create(['nim' => '2019150080', 'no_pembayaran' => '	0013-11.22-SK',]);

        $request = new MengulangUpdateRequest([
            'email' => 'test1@gmail.com',
            'no_whatsapp' => 'test234',
        ]);

        $this->service->update($mengulang->id, $request);

        $this->assertDatabaseHas('mengulang', [
            'email' => 'test1@gmail.com',
            'no_whatsapp' => 'test234',
        ]);
        $this->assertDatabaseCount('mengulang', 1);
    }
}
