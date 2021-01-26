<?php

namespace App;

use App\Courses;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $guarded = [];
	protected static function boot()
    {
        parent::boot();

        static::created(function ($type) {
            $type->update(['slug' => $type->name]);
        });
    }

	public function setSlugAttribute($value)
    {
        $slug = str::slug($value, '-');

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function schools()
    {
    	return $this->hasMany('App\Schools');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }


    public function courses()
    {
        return $this->belongsToMany(Courses::class)->withTimestamps();
    }

	public function path()
    {
        return '/schools/programme/' . $this->slug;
    }
}
