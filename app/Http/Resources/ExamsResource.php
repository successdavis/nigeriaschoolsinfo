<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamsResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'short_name'        => $this->short_name,
            'slug'              => $this->slug,
            'sypnosis'          => $this->sypnosis,
            'logo_path'         => $this->logo_path,
            'website'           => $this->website,
            'description'       => $this->description,
            'date_created'      => $this->date_created,
            'portal_website'    => $this->portal_website,
            'regStatus'         => $this->registrationStatus(),
            'endsAt'            => $this->registrationEndsAt(),
            'phone'             => $this->phone,
            'email'             => $this->email,

        ];
    }
}
