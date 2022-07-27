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

        $prevImage144 = new stdClass();
        $prevImage144->image = ImageInt::make($file)->resize(144, 144, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 90);
        $prevImage144->filename = "prev_" . $filename . '.webp';
        Storage::put($storage . '/' . $folder . '/thumbnails/144x144/' . $prevImage144->filename, $prevImage144->image->__toString());
        $prevImage144->path = $folder . '/thumbnails/144x144/' . $prevImage144->filename;

        $prevImage512 = new stdClass();
        $prevImage512->image = ImageInt::make($file)->resize(512, 512, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 90);
        $prevImage512->filename = "prev_" . $filename . '.webp';
        Storage::put($storage . '/' . $folder . '/thumbnails/512x512/' . $prevImage512->filename, $prevImage512->image->__toString());
        $prevImage512->path = $folder . '/thumbnails/512x512/' . $prevImage512->filename;

        $originalImage = new stdClass();
        $originalImage->image = ImageInt::make($file)->resize(2000, 2000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('png', 90);
        $originalImage->filename = $filename . '.png';
        Storage::put($storage . '/' . $folder . '/' . $originalImage->filename, $originalImage->image->__toString());
        $originalImage->path = $folder . '/' . $originalImage->filename;

        array_push($images, $prevImage144);
        array_push($images, $prevImage512);
        array_push($images, $originalImage);

        return $images;
    }
}
