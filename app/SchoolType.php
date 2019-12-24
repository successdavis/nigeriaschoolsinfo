<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SchoolType extends Model
{
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


	public function path()
    {
        return '/schools/type/' . $this->slug;
    }
}
