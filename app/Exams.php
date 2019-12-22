<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use Source;
	
    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }
}
