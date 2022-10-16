<?php

namespace Tests\Feature\Traits;

use App\Traits\MediaTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTraitsTest extends TestCase
{
    use MediaTrait, WithFaker;

    public function test_upload()
    {
        $file = UploadedFile::fake()->create('test-file.pdf');
        $result = $this->uploads($file, 'test/');

        $this->assertArrayHasKey('filePath', $result);
        $this->assertTrue(Storage::disk('s3')->exists($result['filePath']));

        Storage::disk('s3')->delete($result['filePath']);
    }
}
