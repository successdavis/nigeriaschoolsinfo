<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use Source;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($school) {
            $school->update(['slug' => $school->name]);
        });
    }

	public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/schools/' . $this->slug;
    }

    public function getRecent()
    {
    	return $this->posts()->limit(20)->get();
    }

    public function setSlugAttribute($value)
    {
        $slug = str::slug($value, '-');

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getLogoPathAttribute($logo)
    {
        if ($logo) {
            return asset('storage/' . $logo);
        }else {
            return asset('storage/schools/logos/default.jpg');
        }
    }
}
