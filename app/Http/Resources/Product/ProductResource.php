<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Attachment\AttachmentResource;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'article' => $this->article,
            'manufacturer' => $this->manufacturer,
            'machines' => $this->machines,
            'desc' => $this->desc,
            'thumb_url' => $this->getUrlCover(),
            'images' => MediaResource::collection($this->getMedia('images')),
            'prices' => SaleResource::collection($this->prices),
            // 'images' => function () {
            //     MediaResource::collection($this->getMedia('images'));
            //     $images = [];

            //     return $images;
            // },
        ];
    }
}
