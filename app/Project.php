<?php

namespace App;

use App\Traits\Billable;
use App\Traits\Downloadable;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use Billable;
    use ModelFunctions;
    use Downloadable;

    protected $fillable = ['slug'];

    public $pathPrefix  = '/project/';
    public $findWith    = 'slug';
    public $excerpt    =   ['description', 23];

    public $maxDownloadAllowed = 5;

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
        }

        // for testing purposes only, else return null is no download path is set
        return Storage::url('projects/accusamus-qui-eius-quia-doloremque-officia-deleniti-qui-iste.docx');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
