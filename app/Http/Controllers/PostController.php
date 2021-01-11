<?php

namespace App\Http\Controllers;

use App\Advertisements;
use App\Courses;
use App\Exams;
use App\Filters\PostFilters;
use App\Http\Resources\PostResource;
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
    public function index(Request $request, PostFilters $filters)
    {
        $request->validate([
            'q'     => 'nullable|string',
            // 'draft' => 'nullable|boolean'
        ]);
        $q = request('q');
        $posts = Post::filter($filters)->latest();

        $trending = Post::orderBy('visits','desc')->limit(10)->get();

        $posts = $posts->paginate(50);

        if (request()->wantsJson()) {
            return PostResource::collection($posts);
        }

        return view('posts.index', compact('posts','q','trending'));
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
        $post->delete();

        return $post;
    }

    public function lock(Post $post)
    {
        $post->lock();

        return back()->with('flash', 'This post is now lock');
    }

    public function unlock(Post $post)
    {
        $post->unlock();

        return back()->with('flash', 'This post is now unlock');
    }

    public function newpostrequirement()
    {
        $exams = Exams::all();
        $courses = Courses::all();
        $schooltype = SchoolType::all();

        return compact('exams', 'courses', 'schooltype');
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

    public function addimage(Request $request)
    {

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

    public function featured_image(Request $request, Post $post)
    {
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $name = $post->slug .'.'.request()->file('file')->getClientOriginalExtension();

        $post->update([
            'featured_image' => request()->file('file')->storeAs('posts', $name, 'public')
        ]);

        return response($post, 200);
    }

    public function publish(Post $post) {
        $post->publish();

        return $post;
    }

    public function unpublish(Post $post) {
        $post->unpublish();

        return $post;
    }
}
