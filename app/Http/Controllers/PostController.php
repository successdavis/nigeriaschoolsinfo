<?php

namespace App\Http\Controllers;

use App\Advertisements;
use App\Courses;
use App\Exams;
use App\Post;
use App\SchoolType;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertisements = Advertisements::activeAdverts();
        // $posts = Post::where('title', 'LIKE', '%' . request('search') . '%')
        //     ->orWhere('body', 'LIKE', '%' . request('search') . '%')->get();

        return view('welcome', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $module = 'App\\' . ucwords(strtolower($request->module));
        if(class_exists($module)) {
            $handler = $module::find($request->module_id);
            $params = ['title' => $request->title, 'body' => $request->body];
            return $handler->publishPost($params);
        }

        abort('Something isn\'t right!', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $relatedPosts = $post->source->getRecent();
        // dd($relatedPosts);
        return view('posts.show', compact('post','relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        dd($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function newpostrequirement()
    {
        $exams = Exams::all();
        $courses = Courses::all();
        $schooltype = SchoolType::all();

        return compact('exams', 'courses', 'schooltype');
    }
}
