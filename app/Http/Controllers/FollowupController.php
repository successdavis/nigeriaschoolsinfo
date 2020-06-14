<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FollowupController extends Controller
{
    // Followup post are post that display under a particular school, job or model.

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
