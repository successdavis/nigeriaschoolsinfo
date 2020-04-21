<?php

namespace App\Http\Controllers;

use App\Filters\ScholarshipFilters;
use App\Http\Resources\ScholarshipResource;
use App\scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
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
    public function index(ScholarshipFilters $filters)
    {
        $scholarships = $this->getScholarships($filters);

        if (request()->wantsJson()) {
            return ScholarshipResource::collection($scholarships);
        }

        return view('scholarships.index', compact('scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scholarships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Scholarship);

        $request->validate([
            'title'         => 'required|string|max:70',
            'description'   => 'required|min:100',
            'location'      => 'required|string',
            // 'ends_at'       =>  'required'
        ]);


        $scholarship = new Scholarship;

        $scholarship->title             = $request->title;
        $scholarship->description       = $request->description;
        $scholarship->meta_description  = $request->meta_description;
        $scholarship->portal_website    = $request->portal_website;
        $scholarship->user_id           = Auth()->user()->id;
        $scholarship->location          = $request->location;
        $scholarship->institution       = $request->institution;
        $scholarship->ends_at           = $request->ends_at;
        $scholarship->admitting         = true;

        $scholarship->save();

        if (request()->wantsJson()) {
            return $scholarship;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show(Scholarship $scholarship)
    {
        $scholarship->increment('visits');
        return view('scholarships.show', compact('scholarship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function edit(Scholarship $scholarship)
    {
        return view('scholarships.create', compact('scholarship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scholarship $scholarship)
    {
        $this->authorize('update', $scholarship);
        
        $request->validate([
            'title'         => 'required|string|max:100',
            'description'   => 'required|min:100',
            'location'      => 'required|string',
            'ends_at'       =>  'required'
        ]);

        $scholarship->title             = $request->title;
        $scholarship->description       = $request->description;
        $scholarship->meta_description  = $request->meta_description;
        $scholarship->portal_website    = $request->portal_website;
        $scholarship->location          = $request->location;
        $scholarship->institution       = $request->employer;
        $scholarship->ends_at           = $request->ends_at;

        $scholarship->save();

        if (request()->wantsJson()) {
            return $scholarship;
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scholarship $scholarship)
    {
        //
    }

    public function getScholarships($filters)
    {
        $scholarships = Scholarship::orderBy('updated_at','DESC')->filter($filters);
        
        return $scholarships = $scholarships->paginate(50);
    }
}
