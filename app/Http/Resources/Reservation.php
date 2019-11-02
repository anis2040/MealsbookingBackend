<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reservation extends JsonResource
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
            'nbperson' => $this->nbperson,
            'time' => $this->time,
            'approved' => $this->approved,
            'restaurant' => $this->restaurant,
            'user' => $this->user,

        ];
    }
}
