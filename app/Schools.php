<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use Source;

    protected $guarded = [];

    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }
}
