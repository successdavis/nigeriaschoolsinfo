<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $guarded = [];
    public $pathPrefix = '/courses/';
    public $findWith    =   'slug';

    use ModelFunctions;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($course) {
            $course->update(['slug' => $course->name]);
        });
    }
}
