<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $guarded = [];

    use ModelFunctions;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($course) {
            $course->update(['slug' => $course->name]);
        });
    }

	public function path()
    {
        return '/courses/' . $this->slug;
    }
}
