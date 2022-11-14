<?php

namespace Tests\Feature\Repositories;

use App\Repositories\MengulangRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MengulangRepositoryTest extends TestCase
{
   use RefreshDatabase, WithFaker;

    private MengulangRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(MengulangRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }
}
