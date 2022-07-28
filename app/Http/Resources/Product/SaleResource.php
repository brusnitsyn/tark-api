<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'start' => $this->when(!is_null($this->start), $this->start),
            'end' => $this->when(!is_null($this->end), $this->end),
            'oldPrice' => $this->when(!is_null($this->oldPrice), $this->oldPrice),
            'price' => $this->price,
            'isInfinite' => (bool)$this->is_infinite,
        ];
    }
}
