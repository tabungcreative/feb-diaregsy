<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait MediaTrait
{
    public function uploads($file, $path)
    {
        if ($file) {
            $fileName   = time();
            $fileType  = $file->getClientOriginalExtension();
            $filePath   = $path . $fileName . '.' . $fileType;
            Storage::disk('s3')->put($filePath, File::get($file));
            return $filePath;
        }
    }

    public function delete($path) {
        Storage::disk('s3')->delete($path);
    }
}
