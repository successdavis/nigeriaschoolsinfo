<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'body'          => $this->body,
            'created_at'    => $this->created_at->diffForHumans(),
            'slug'          => $this->slug,
            'title'         => $this->title,
            'updated_at'    => $this->updated_at,
            'path'          => $this->path(),
            'author'        => $this->publisher->name,
            'category'      => $this->source->getClassName(),
            'visits'        => $this->visits,
            'followup'      => $this->followup,
        ];
    }
}
