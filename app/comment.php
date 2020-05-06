<?php

namespace App;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $with = ['owner'];
    
    public static function boot ()
    {
        parent::boot();

        static::deleting(function ($comment) {
            $comment->comments->each->delete();
        });
    }

    public function comments()
    {
        return $this->hasMany(comment::class, 'parent_id');
    }

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return $this->commentable->path() . "#reply-{$this->id}";
    }

	public function commentable()
    {
        return $this->morphTo();
    }

    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function isBest()
    {
        return $this->commentable->best_comment_id == $this->id;
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
