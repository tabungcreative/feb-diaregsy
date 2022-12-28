<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Media
{
    public function uploads($file, $path)
    {
        if ($file) {

            $fileName   = time() . $file->getClientOriginalName();
            Storage::disk('s3')->put($path . $fileName, File::get($file));
            $file_name  = $file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $filePath   = $path . $fileName;

            /** @var \Illuminate\Filesystem\FilesystemManager $disk */
            $disk = Storage::disk('s3');
            $url = $disk->url($filePath);

            return $file = [
                'fileName' => $file_name,
                'fileType' => $file_type,
                'filePath' => $filePath,
                'fileUrl' => $url,
                'fileSize' => $this->fileSize($file)
            ];
        }
    }

    public function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
