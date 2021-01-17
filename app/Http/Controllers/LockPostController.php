<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LockPostController extends Controller
{
   
    public function store(Post $post)
    {
        $this->authorize('update', $post);
        $post->lock();

        return back()->with('flash', 'This post is now lock');
    }

    public function delete(Post $post)
    {
        $this->authorize('update', $post);
        $post->unlock();

        return back()->with('flash', 'This post is now unlock');
    }

}
