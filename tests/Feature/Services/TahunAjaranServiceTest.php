<?php

namespace Tests\Feature\Services;

use App\Http\Requests\TahunAjaran;
use App\Models\TahunAjaran as ModelsTahunAjaran;
use App\Services\TahunAjaranService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TahunAjaranServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private TahunAjaranService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(TahunAjaranService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }

    public function testAddTahunAjaranSuccess()
    {
        $request = new TahunAjaran([
            'tahun' => '2022',
            'semester' => '1',
        ]);

        $this->service->addTahunAjaran($request);

        $this->assertDatabaseCount('tahun_ajaran', 1);
        $this->assertDatabaseHas('tahun_ajaran', [
            'tahun' => '2022',
            'semester' => '1',
        ]);
    }

    public function testActive()
    {
        $tahunAjaran = ModelsTahunAjaran::factory()->create(['is_active' => 0]);
        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 0
        ]);
        $result = $this->service->active($tahunAjaran->id);
        $this->assertDatabaseHas('tahun_ajaran', [
            'is_active' => 1
        ]);
    }
}