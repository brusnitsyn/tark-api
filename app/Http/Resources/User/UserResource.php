<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Org\OrgResource;
use App\Http\Resources\Org\OrgUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'call' => $this->call,
            'org' => $this->when($this->relationLoaded('org'), OrgResource::make($this->org)),
        ];
    }
}
