<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Source
{
    public function posts()
    {
    	$this->morphMany('App\Post', 'source');
    }
}
