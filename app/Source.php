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
                    'user_id'           => auth()->id(),
                    'body'    		    => $params['body'],
                    'meta_description'  => $params['meta_description'],  
                    'title'             => $params['title'],  
                ])
        );

        return $post;
    }

    public function followupPosts()
    {
        return $this->posts()->where('followup', true)->get();
    }

    public function getClassName() {
        return (new \ReflectionClass($this))->getShortName();
    }
}
