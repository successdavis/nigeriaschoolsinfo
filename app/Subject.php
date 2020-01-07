<?php

namespace App;

use App\Courses;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function courses()
    {
    	$this->belongsToMany(Courses::class);
    }
}
