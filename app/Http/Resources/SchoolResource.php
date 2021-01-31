<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'description'       => $this->description,
            'short_name'        => $this->short_name,
            'cut-of points'     => $this->cut_of_points,
            'date_created'      => $this->date_created,
            'logo_path'         => $this->logo_path,
            'website'           => $this->website,
            'portal_website'    => $this->portal_website,
            'state'             => $this->state,
            'lga'               => $this->lga,
            'address'           => $this->address,
            'admitting'         => $this->admitting,
            'programme_id'      => $this->programme_id,
            'sponsored'         => $this->sponsored,
            'jamb_points'       => $this->jamb_points,
            'phone'             => $this->phone,
            'visits'            => $this->visits,
            'email'             => $this->email,
            'slug'              => $this->slug,
            'path'              => $this->path(),
            'excerpt'           => $this->excerpt(),
            'courses_count'     => $this->courses->count(),
            'programme'         => $this->programme->name,
            'sponsor'           => $this->sponsored->name,

        ];
    }
}
