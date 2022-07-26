<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;
use stdClass;

trait Uploadable
{
    public function upload($file, $storage = 'public', $folder = 'uploads')
    {
        // $image = ImageInt::make($file)->encode('webp', 100);

        $filename = uniqid();
        $images = [];

        $prevImage = new stdClass();
        $prevImage->image = ImageInt::make($file)->resize(144, 144, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 90);
        $prevImage->filename = "prev_" . $filename . '.webp';
        Storage::put($storage . '/' . $folder . '/thumbnails/144x144/' . $prevImage->filename, $prevImage->image->__toString());
        $prevImage->path = $folder . '/thumbnails/144x144/' . $prevImage->filename;

        $originalImage = new stdClass();
        $originalImage->image = ImageInt::make($file)->resize(2000, 2000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('png', 90);
        $originalImage->filename = $filename . '.png';
        Storage::put($storage . '/' . $folder . '/' . $originalImage->filename, $originalImage->image->__toString());
        $originalImage->path = $folder . '/' . $originalImage->filename;

        array_push($images, $prevImage);
        array_push($images, $originalImage);

        return $images;
    }
}
