<?php

namespace Tests\Feature\Services;

use App\Services\UjianAkhirService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UjianAkhirServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private UjianAkhirService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = $this->app->make(UjianAkhirService::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }
}
