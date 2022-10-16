<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\SPL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SPLControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testVerify()
    {
        $spl = SPL::factory()->create(['is_verify' => 0]);
        $response = $this->post(route('admin.spl.verify', $spl->id));

        $response->assertStatus(302);

        $this->assertDatabaseCount('spl', 1);
        $this->assertDatabaseHas('spl', [
            'is_verify' => 1,
        ]);
    }

    public function testCreateMessage()
    {
        $spl = SPL::factory()->create();
        $response = $this->post(route('admin.spl.create-message', $spl->id), [
            'pesan' => 'new message',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseCount('spl', 1);
        $this->assertDatabaseHas('spl', [
            'keterangan' => 'new message',
        ]);
    }
}
