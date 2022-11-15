<?php

namespace Tests\Feature\Services;

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
}
