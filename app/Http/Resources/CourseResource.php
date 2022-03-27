<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'description'   => $this->description,
            'faculty'       => $this->faculty,
            'logo_path'     => $this->logo_path,
            'salary'        => $this->salary,
            'slug'          => $this->slug,
            'duration'      => $this->duration,
            'excerpt'       => $this->excerpt(),
            // 'schools'       => $this->schools()->limit(40)->get(),
            'utme_comment'  => $this->utme_comment,
            'utme_requirement'  => $this->utme_requirement,
            'direct_requirement'  => $this->direct_requirement,
            'considerations'  => $this->considerations,
            'subjects'       => $this->subjects,
            'path'           => $this->path(),
            'visits'           => $this->visits,
            'programmes'       => $this->programmes()->pluck('id'),

        ];
    }
}
