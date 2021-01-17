<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostImageController extends Controller
{
   
    public function addimage(Request $request)
    {
        $this->authorize('create', $post);
        
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $name = pathinfo(request()->file('file')->getClientOriginalName(), PATHINFO_FILENAME);

        $newName = str_replace(' ', '-', $name).'.'.request()->file('file')->getClientOriginalExtension();

        $path = request()->file('file')->storeAs('posts', $newName, 'public');

        $src =  asset('storage/'.$path);

        return response()
            ->json([
                'src' => $src,
                'alt' => $name
            ]);
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('create', $post);
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $name = $post->slug .'.'.request()->file('file')->getClientOriginalExtension();

        $post->update([
            'featured_image' => request()->file('file')->storeAs('posts', $name, 'public')
        ]);

        return response($post, 200);
    }
}
