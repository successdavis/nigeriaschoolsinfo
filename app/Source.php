<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Source
{
    public function posts()
    {
    	return $this->morphMany('App\Post', 'source')->latest();
    }

        //    to create post for a model;
    public function publishPost($params = [])
    {
        $post = $this->posts()->save(
                new Post([
                    'user_id'       => auth()->id(),
                    'body'    		=> $params['body'],
                    'title'         => $params['title'],  
                ])
        );

        return $post;
    }
}
