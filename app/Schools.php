<?php

namespace App;

use App\Faculties;
use App\Lga;
use App\Programme;
use App\Sponsored;
use App\States;
use App\Traits\Insertinbetweentext;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\SchoolFilters;
use Illuminate\Support\Str;

class Schools extends Model
{
    use Source;
    use ModelFunctions;
    // use Insertinbetweentext;

    protected $guarded = [];
//    protected $with = ['courses'];
    protected $casts = [
        'admitting' => 'boolean',
        'hostels_accomodation' => 'boolean'
    ];

    protected $dates = ['date_created','reg_ends_at'];

    public $pathPrefix  = '/schools/';
    public $findWith    =   'slug';
    public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($school) {
            $school->update(['slug' => $school->name]);
        });
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class)->withPivot('cut_off_points');
    }

    public function sponsored()
    {
        return $this->belongsTo(Sponsored::class);
    }

    public function state()
    {
        return $this->belongsTo(States::class, 'states_id');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function photos()
    {
        return $this->hasMany('App\Schoolphoto', 'schools_id');
    }

    public function addCourse($course, $cut_off_points = null)
    {
        $this->courses()->attach($course->id, ['cut_off_points' => $cut_off_points]);
    }

    public function getRecent()
    {
    	return $this->posts()->limit(10)->get();
    }

    public function TypeOf()
    {
        return $this->Programme->name;
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

    public function openAdmission($endDate)
    {
        return $this->update([
            'admitting' => true,
            'reg_ends_at' => $endDate
        ]);
    }

    public function closeAdmission()
    {
        return $this->update([
            'admitting' => false
        ]);
    }

    public function isAdmitting()
    {
        return !! $this->admitting;
    }
}
