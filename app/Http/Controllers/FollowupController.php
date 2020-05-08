<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FollowupController extends Controller
{
    public function store(Post $post)
    {
    	$post->markAsFollow();

    	return response('Success', 200);
    }

    public function destroy(Post $post)
    {
    	$post->unmarkAsFollow();

    	return response('Success', 200);
    }
}
