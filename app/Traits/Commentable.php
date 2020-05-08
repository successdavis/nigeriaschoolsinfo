<?php

namespace App\Traits;

use App\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Commentable
{
    public function comments ()
    {
        return $this->morphMany(comment::class, 'commentable');
    }
}
