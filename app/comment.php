<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function owner()
    {
    	return $this->belongsTo('App\User');
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
}
