<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\ModelFunctions;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
    use ModelFunctions;
    use Commentable;
    protected $guarded = [];

    public $pathPrefix  = '/posts/';
    public $findWith    =   'slug';
    public $excerpt    =   ['body', 23];

    protected $casts = [
        'locked'       => 'boolean',
        'followup'      => 'boolean',
        'published'     => 'boolean'
    ];

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

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function publisher()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function lock()
    {
        $this->update(['locked' => true]);
    }

    public function unlock()
    {
        $this->update(['locked' => false]);
    }

    public function hasFeaturedImage()
    {
        return $this->featured_image !== "";
    }

    public function getFeaturedImageAttribute($image)
    {
        if ($image) {
            return asset('storage/' . $image);
        }else {
            return '';
        }
    }

    public function isFollowUp()
    {
        return $this->followup;
    }

    public function markAsFollow()
    {
        $this->followup = true;
        $this->save();
        return true;
    }

    public function unmarkAsFollow()
    {
        $this->followup = false;
        $this->save();
        return true;
    }

    public function publish() {
        $this->published = true;
        $this->save();

        return true;
    }

    public function unpublish() {
        $this->published = false;
        $this->save();

        return true;
    }
}
