<?php

namespace App\Data;

use App\Casts\ObjectData;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

final class ProductData extends ObjectData
{
    public ?int $id;
    public string $name;
    public ?string $article;
    public ?string $manufacturer;
    public ?string $machines;
    public ?string $desc;
    public ?float $price;
    public ?array $images;

    public static function fromRequest(
        Request $request
    ): ProductData {
        return new ProductData(
            id: $request->get('id'),
            name: $request->get('name'),
            article: $request->get('article'),
            manufacturer: $request->get('manufacturer'),
            machines: $request->get('machines'),
            desc: $request->get('desc'),
            price: $request->get('price'),
            images: $request->file('images'),
        );
    }
}
