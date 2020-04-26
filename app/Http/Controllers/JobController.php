<?php

namespace App\Http\Controllers;

use App\Filters\JobFilters;
use App\Http\Resources\JobResource;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function __construct() 
    {
        return $this->Middleware(['auth'])->except(['index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobFilters $filters)
    {
        $jobs = $this->getJobs($filters);

        if (request()->wantsJson()) {
            return JobResource::collection($jobs);
        }

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $this->authorize('create', new Job)) {
            return response('Please wait atleast 5min before trying again', 429);
        };

        $request->validate([
            'title'             => 'required|string|max:70',
            'description'       => 'required|min:100',
            'location'          => 'required|string',
            'ends_at'           =>  'required',
            'meta_description'  =>  'required'
        ]);

        $job = new Job;

        $job->title             = $request->title;
        $job->description       = $request->description;
        $job->meta_description  = $request->meta_description;
        $job->portal_website    = $request->portal_website;
        $job->user_id           = Auth()->user()->id;
        $job->phone             = $request->phone;
        $job->location          = $request->location;
        $job->employer          = $request->employer;
        $job->ends_at           = $request->ends_at;

        $job->save();

        if (request()->wantsJson()) {
            return $job;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $job->increment('visits');
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('jobs.create', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);
        
        $request->validate([
            'title'         => 'required|string|max:70',
            'description'   => 'required|min:100',
            'location'      => 'required|string',
            'ends_at'       =>  'required'
        ]);

        $job->title             = $request->title;
        $job->description       = $request->description;
        $job->meta_description  = $request->meta_description;
        $job->portal_website    = $request->portal_website;
        $job->phone             = $request->phone;
        $job->location          = $request->location;
        $job->employer          = $request->employer;
        $job->ends_at           = $request->ends_at;

        $job->save();

        if (request()->wantsJson()) {
            return $job;
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function getJobs($filters)
    {
        $jobs = Job::orderBy('updated_at','DESC')->filter($filters);
        
        return $jobs = $jobs->paginate(30);
    }

    public function featured_image(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $request->validate([
            'file' => ['required', 'image']
        ]);

        $name = $job->slug .'.'.request()->file('file')->getClientOriginalExtension();

        $job->update([
            'featured_image' => request()->file('file')->storeAs('jobs', $name, 'public')
        ]);

        return response($job, 200);
    }
}
