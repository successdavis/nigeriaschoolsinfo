<?php

namespace App\Http\Controllers;

use App\Post;
use App\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $post->load('comments.owner');
        $comments = $post->comments()->paginate(25)->groupBy('parent_id');
        if (isset($comments[''])) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }

        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $comment = new comment;
        $comment->body = $request->body;
        $comment->user_id = Auth()->user()->id;
        $comment->parent_id = $request->parent_id;

        $post->comments()->save($comment);

        return $comment = comment::find($comment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        $this->authorize('update', $comment);
        
        $comment->body = $request->body;

        $comment->save();

        if (request()->expectsJson()) {
            return response(['status' => 'Comment updated']);
        }

        return back()
            ->with('flash', 'Comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();


        if (request()->expectsJson()) {
            return response(['status' => 'Comment Deleted']);
        }

        return back()
            ->with('flash', 'Comment Deleted');
    }
}
