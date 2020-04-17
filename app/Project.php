<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use ModelFunctions;

    protected $fillable = ['slug'];

    public $pathPrefix  = '/project/';
    public $findWith    =   'slug';
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

    public function category()
    {
        return $this->belongsTo('App\Projectcategory', 'category_id');
    }

    public function getDownloadPathAttribute($downloadpath)
    {
        if ($downloadpath) {
            return asset('storage/' . $downloadpath);
        }else {
            return asset('storage/projects/default.jpg');
        }
    }

}
