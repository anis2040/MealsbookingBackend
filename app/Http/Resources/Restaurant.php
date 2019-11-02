<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Restaurant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'photo' => $this->photo,
            'address' => $this->address,
            'category' => $this->category,
            'ratings' => $this->ratings,
            'priceMin' => $this->priceMin,
            'priceMax' => $this->priceMax,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
