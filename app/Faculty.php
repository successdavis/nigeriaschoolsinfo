<?php

namespace App;

use App\Courses;
use App\Schools;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $guarded = [];

    public function schools()
    {
    	return $this->hasMany(Courses::class);
    }
}
