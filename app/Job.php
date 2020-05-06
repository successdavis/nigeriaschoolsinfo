<?php

namespace App;

use App\Source;
use App\Traits\Commentable;
use App\Traits\ModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Job extends Model
{
    use Source;
    use Commentable;
    use ModelFunctions;

    protected $fillable = ['slug','recruiting','ends_at','featured_image'];
    public $pathPrefix  = '/jobs/';
    public $findWith    =   'slug';
    public $excerpt    =   ['meta_description', 23];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'ends_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($job) {
            $job->update(['slug' => $job->title]);
        });
    }

    public function openRecruitment($endDate = null)
    {
        return $this->update([
            'recruiting' => true,
            'ends_at'   => $endDate
        ]);
    }

    public function recruitmentStatus()
    {
        return $this->recruiting ? 'Open' : 'Closed';
    }

    public function closeRegistration()
    {
        return $this->update([
            'recruiting' => false,
        ]);
    }

    public function recuritmentEndsAt()
    {
        return $this->ends_at ? $this->ends_at->diffForHumans() : 'Undefined';
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function getRecent()
    {
        return $this->posts()->limit(10)->get();
    }
}
