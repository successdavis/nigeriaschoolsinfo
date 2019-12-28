<?php

namespace App;

use App\Traits\ModelFunctions;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use ModelFunctions;
    protected $guarded = [];

    public $pathPrefix  = '/posts/';
    public $findWith    =   'slug';
    public $excerpt    =   ['body', 23];


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

    public function publisher()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
