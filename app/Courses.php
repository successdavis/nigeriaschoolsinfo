<?php

namespace App;

use App\Consideration;
use App\Schools;
use App\Subject;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $guarded = [];
    public $pathPrefix = '/courses/';
    public $findWith    =   'slug';
    public $excerpt    =   ['description', 23];
    protected $with     = ['subjects'];
    

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

    public function considerations()
    {
        return $this->hasMany(Consideration::class, 'course_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function attachSubject($subject)
    {
        $this->subjects()->attach($subject->id);
    }

    public function attachSchool($school, $cut_off_points = null)
    {
        $this->schools()->attach($school, ['cut_off_points' => $cut_off_points]);
    }

    public function detachSchool($school)
    {
        return $this->schools()->detach($school);
    }

    public function attachSubjects($subjects)
    {
        $previousSubjects = $this->subjects->pluck('id');
        
        $this->subjects()->detach($previousSubjects);

        $this->subjects()->attach($subjects);
    }
}
