<?php

namespace App;

use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exams extends Model
{
    use Source;
    use ModelFunctions;

    protected $guarded  = [];
    public $pathPrefix  = '/exams/';
    public $findWith    =   'slug';
    public $excerpt    =   ['description', 23];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($exam) {
            $exam->update(['slug' => $exam->name]);
        });
    }

    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }

    public function getLogoPathAttribute($logo)
    {
        if ($logo) {
            return asset('storage/' . $logo);
        }else {
            return asset('storage/exams/logos/default.jpg');
        }
    }

    public function openRegistration($endDate = null)
    {
        return $this->update([
            'admitting' => true,
            'ends_at'   => $endDate
        ]);
    }

    public function registrationStatus()
    {
        return $this->admitting ? 'Open' : 'Closed';
    }

    public function closeRegistration()
    {
        return $this->update([
            'admitting' => false,
        ]);
    }

    public function registrationEndsAt()
    {
        return $this->ends_at ? $this->ends_at->diffForHumans() : 'Undefined';
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
