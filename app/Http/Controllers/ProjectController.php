<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Filters\ProjectFilters;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Courses $course, ProjectFilters $filters)
    {
        $projects = $this->getProjects($course, $filters);


        $courses =  Courses::orderBy('name')->withCount('projects');
        $courses = $courses->limit(50)->get();

        if ($course->exists) {
            return view('projects.index', compact('projects','courses', 'course'));
        }

        return view('projects.index', compact('projects','courses', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'title'         => 'required|string',
            'description'   => 'required',
            'course_id'   => 'required|exists:courses,id',
            'schooltype_id'   => 'required|exists:school_types,id',
        ]);

        $project                = new Project;
        $project->title         = $request->title;
        $project->description   = $request->description;
        $project->user_id       = Auth()->user()->id;
        $project->course_id   = $request->course_id;
        $project->schooltype_id = $request->schooltype_id;
        $project->amount        = $request->amount;

        $project->save();

        if (request()->wantsJson()) {
            return response($project, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $relatedProjects = Project::where('course_id', $project->course->id)->latest()->limit(20)->get();
        $project->increment('visits');
        return view('projects.show', compact('project','relatedProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'         => 'required|string',
            'description'   => 'required',
            'schooltype_id' => 'required'
        ]);

        $project->title         = $request->title;
        $project->description   = $request->description;
        $project->amount        = $request->amount;
        $project->schooltype_id = $request->schooltype_id;

        $project->save();

        if (request()->wantsJson()) {
            return response($project, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function getProjects($course, $filters)
    {
        $projects = Project::orderBy('title')->filter($filters);

        if ($course->exists) {
            $projects->where('course_id', $course->id);
        }

        return $projects = $projects->paginate(20);
    }
}
