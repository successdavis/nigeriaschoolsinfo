<?php

namespace App\Http\Controllers;

use App\Job;
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
    public function index(Request $request)
    {
        $request->validate([
            'commentable_id'    => 'required|int',
            'commentable_type'  => 'required|string'
        ]);

        $module = 'App\\' . ucwords(strtolower($request->commentable_type));
        if (!class_exists($module)) {
            abort(400, 'Something isn\'t right!');
        }

        if (!$module::where('id',$request->commentable_id)->exists()) {
            abort(400, 'Please provide a valid module id');
        }

        $id     = $request->commentable_id;
        $comments = Comment::where('commentable_type', $module)
            ->where('commentable_id', $id);

        // $post->load('comments.owner');

        $comments = $comments->paginate(25)->groupBy('parent_id');

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
    public function store(Request $request)
    {
        $request->validate([
            'body'              => 'required|string',
            'parent_id'         => 'nullable|int',
            'commentable_id'    => 'required|int',
            'commentable_type'  => 'required|string'
        ]);

        $module = 'App\\' . ucwords(strtolower($request->commentable_type));
        if (!class_exists($module)) {
            abort(400, 'Something isn\'t right!');
        }

        if (!$module::where('id',$request->commentable_id)->exists()) {
            abort(400, 'Please provide a valid module id');
        }

        $handler = $module::find($request->commentable_id);

        $comment = new comment;
        $comment->body = $request->body;
        $comment->user_id = Auth()->user()->id;
        $comment->parent_id = $request->parent_id;

        $handler->comments()->save($comment);

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
