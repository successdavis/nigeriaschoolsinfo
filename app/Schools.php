<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\SchoolFilters;
use Illuminate\Support\Str;

class Schools extends Model
{
    use Source;
    use ModelFunctions;

    protected $guarded = [];

    public $pathPrefix  = '/schools/';
    public $findWith    =   'slug';

    protected static function boot()
    {
        parent::boot();

        static::created(function ($school) {
            $school->update(['slug' => $school->name]);
        });
    }

    public function SchoolType()
    {
        return $this->belongsTo('App\SchoolType');
    }

    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }

    public function TypeOf()
    {
        return $this->SchoolType->name;
    }

    public function getLogoPathAttribute($logo)
    {
        if ($logo) {
            return asset('storage/' . $logo);
        }else {
            return asset('storage/schools/logos/default.jpg');
        }
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
