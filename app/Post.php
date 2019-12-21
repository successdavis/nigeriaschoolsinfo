<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function source()
    {
        return $this->morphTo();
    }

	public function getRouteKeyName()
    {
        return 'title';
    }


    public function path()
    {
        return '/posts/' . $this->title;
    }
}
