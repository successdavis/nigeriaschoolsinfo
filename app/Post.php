<?php

namespace App;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            $post->update(['slug' => $post->title]);
        });
    }


    public function source()
    {
        return $this->morphTo();
    }

	public function getRouteKeyName()
    {
        return 'slug';
    }


    public function path()
    {
        return '/posts/' . $this->slug;
    }

    public function publisher()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setSlugAttribute($value)
    {
        $slug = str::slug($value, '-');

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }
}
