<?php

namespace App;

use App\Courses;
use App\Schools;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
	use ModelFunctions;

    protected $guarded = [];

    public $pathPrefix  = '/faculty/';
    public $findWith    =   'slug';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($school) {
            $school->update(['slug' => $school->name]);
        });
    }


    public function courses()
    {
    	return $this->hasMany(Courses::class);
    }
}
