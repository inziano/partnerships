<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Partner extends JsonResource
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
            'abbreviation' => $this->abbreviation,
            'location' => $this->location,
            'type' => $this->type,
            'address' => $this->address,
            'country' => $this->country,
            'field' => $this->field,
            'logo' => $this->logo,
        ];
    }
}
