<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class PublishPostController extends Controller
{
	public function store(Post $post) {
		$this->authorize('publish', $post);
        $post->publish();

        return $post;
    }

    public function destroy(Post $post) {
    	$this->authorize('unpublish', $post);

        $post->unpublish();

        return $post;
    }
}
