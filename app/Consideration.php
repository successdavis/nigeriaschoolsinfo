<?php

namespace App;

use App\Courses;
use Illuminate\Database\Eloquent\Model;

class Consideration extends Model
{
    protected $guarded = [];

    public function course()
    {
    	return $this->belongsTo(Courses::class, 'course_id');
    }
}
