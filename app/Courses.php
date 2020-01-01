<?php

namespace App;

use App\Schools;
use App\Subject;
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

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function schools()
    {
        return $this->belongsToMany(Schools::class)->withPivot('cut_off_points');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function attachSubject($subject)
    {
        $this->subjects()->attach($subject->id);
    }
}
