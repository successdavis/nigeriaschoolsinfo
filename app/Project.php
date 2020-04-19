<?php

namespace App;

use App\Traits\Billable;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Billable;
    use ModelFunctions;

    protected $fillable = ['slug'];

    public $pathPrefix  = '/project/';
    public $findWith    = 'slug';
    public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($project) {
            $project->update(['slug' => $project->title]);
        });
    }

    public function SchoolType()
    {
        return $this->belongsTo('App\SchoolType', 'schooltype_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Courses', 'course_id');
    }

    public function getDownloadPathAttribute($downloadpath)
    {
        if ($downloadpath) {
            return asset('storage/' . $downloadpath);
        }else {
            return asset('storage/projects/default.jpg');
        }
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
