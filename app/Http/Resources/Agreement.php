<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\Partner as PartnerResource;
use App\Partner;
use App\Contact;

class Agreement extends JsonResource
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
            'title' => $this->title,
            'type' => $this->type,
            'tags' => $this->tags,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'purpose' => $this->purpose,
            'partner' => PartnerResource::collection(Partner::where('id', $this->partner_id)->get()),
            'contact' => ContactResource::collection(Contact::where('agreement_id', $this->id)->get()),
        ];
    }
}
