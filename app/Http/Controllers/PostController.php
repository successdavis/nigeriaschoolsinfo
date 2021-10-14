<?php

namespace App\Http\Controllers;

use App\Advertisements;
use App\Courses;
use App\Exams;
use App\Filters\PostFilters;
use App\Filters\SchoolFilters;
use App\Http\Resources\PostResource;
use App\Post;
use App\Programme;
use App\Schools;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PostFilters $filters, SchoolFilters $schoolfilters)
    {
        dd('here');
        $request->request->add(['a' => 'admitting']);

        $request->validate([
            'q'     => 'nullable|string',
            // 'draft' => 'nullable|boolean'
        ]);
        $q = request('q');
        $posts = Post::filter($filters)->latest();

        $trending = Post::orderBy('visits','desc')->limit(10)->get();

        $posts = $posts->paginate(50);


        $schoolsAdmitting = Schools::filter($schoolfilters)->limit(50)->select('name','reg_ends_at')->get();

        if (request()->wantsJson()) {
            return PostResource::collection($posts);
        }

        return view('posts.index', compact('posts','q','trending','schoolsAdmitting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Post);
        $request->validate([
            'title'     => 'required|max:100|min:25',
            'body'      => 'required',
            'module'    => 'required',
            'module_id'    => 'required',
        ]);

        $module = 'App\\' . ucwords(strtolower($request->module));
        if(class_exists($module)) {
            $handler = $module::find($request->module_id);
            $params = [
                'title' => $request->title, 
                'body' => $request->body,
                'meta_description' => $request->meta_description
            ];
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
        $post->increment('visits');
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
        $this->authorize('update', $post);
        return new PostResource($post);
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
        $this->authorize('update', $post);

        $request->validate([
            'title'     => 'required|max:100|min:25',
            'body'      => 'required',
            'module'    => 'required',
            'module_id'    => 'required',
        ]);

        // Validate the module and module_id if the user happens to change the post type

        $module = 'App\\' . ucwords(strtolower($request->module));

        if ($post->source_type !== $module) {
            if(!class_exists($module)) {
                abort(400, 'Bad Request');
            }
        }

        $post->update([
            'title'             => $request->title,
            'body'              => $request->body,
            'source_type'       => $module,
            'source_id'         => $request->module_id,
            'meta_description'  => $request->meta_description
        ]);

        return Response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return $post;
    }

    public function newpostrequirement()
    {
        $exams = Exams::all();
        $courses = Courses::all();
        $programmes = Programme::all();

        return compact('exams', 'courses', 'programmes');
    }

    public function relatedpost(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'module' => 'required',
        ]);

        $module = 'App\\' . ucwords(strtolower($request->module));
        if(class_exists($module)) {
            $handler = $module::find($request->module_id);

            $posts = $handler->posts()->limit(10)->get();
            return PostResource::collection($posts);
        }

        abort('Something isn\'t right!', 400);
    }
}
