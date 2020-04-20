<?php

namespace App;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use ModelFunctions;

    protected $fillable = ['slug','admitting','ends_at'];

    public $pathPrefix  = '/scholarship/';
    public $findWith    = 'slug';
    public $excerpt    =   ['description', 23];

    protected $dates = [
        'created_at',
        'updated_at',
        'ends_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($scholarship) {
            $scholarship->update(['slug' => $scholarship->title]);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function openApplication($endDate = null)
    {
        return $this->update([
            'admitting' => true,
            'ends_at'   => $endDate
        ]);
    }

    public function applicationStatus()
    {
        return $this->admitting ? 'Open' : 'Closed';

    }

    public function closeApplication()
    {
        return $this->update([
            'admitting' => false,
        ]);
    }

    public function applicationEndsAt()
    {
        return $this->ends_at ? $this->ends_at->diffForHumans() : 'Undefined';
    }
}
