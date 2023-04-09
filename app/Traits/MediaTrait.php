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
            Storage::disk('public')->put($filePath, File::get($file));
            return $filePath;
        }
    }

    public function delete($path) {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
