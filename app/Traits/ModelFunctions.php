<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait ModelFunctions
{
    public function setSlugAttribute($value)
    {
        $slug = str::slug($value, '-');

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
	{
		if (property_exists($this, 'findWith')) {
			return $this->findWith;
		}
	}


    public function path()
    {
    	if (property_exists($this, 'pathPrefix')) {
	        return $this->pathPrefix . $this->slug;
    	}
    }


    public function excerpt()
    {
        $word = $this->excerpt[0];
        $newbody = Str::words($this->$word, $this->excerpt[1], ' ...');

        return $newbody;
    }
}
