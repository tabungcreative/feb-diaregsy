<?php

namespace Tests\Feature\Repositories;

use App\Repositories\DosenRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DosenRepositoryTest extends TestCase
{
    private DosenRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->make(DosenRepository::class);
    }

    public function test_provider()
    {
        $this->assertTrue(true);
    }


    public function listALlDosen()
    {
        $result = $this->repository->getAllDosen();

        $result->assertStatus(200);
    }
}
