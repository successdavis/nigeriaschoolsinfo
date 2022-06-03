<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseIndexPageResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'short_name'    => $this->short_name,
            'faculty'       => $this->faculty,
            'salary'        => $this->salary,
            'slug'          => $this->slug,
            'duration'      => $this->duration,
            'excerpt'       => $this->excerpt(),
            'path'           => $this->path(),
            'visits'           => $this->visits,
        ];
    }
}
