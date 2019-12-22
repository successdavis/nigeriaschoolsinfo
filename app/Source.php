<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Source
{
    public function posts()
    {
    	return $this->morphMany('App\Post', 'source')->latest();
    }
}
