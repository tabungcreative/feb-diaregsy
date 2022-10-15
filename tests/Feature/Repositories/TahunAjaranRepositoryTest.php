<?php

namespace Tests\Feature\Repositories;

use App\Repositories\TahunAjaranRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TahunAjaranRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private TahunAjaranRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(TahunAjaranRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }
}
