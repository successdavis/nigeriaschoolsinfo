<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Filters\SchoolFilters;
use App\Http\Resources\SchoolResource;
use App\School;
use App\Programme;
use App\Schools;
use App\Sponsored;
use App\States;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Programme $programme, SchoolFilters $filters)
    {
        $schools = $this->getSchools($programme, $filters);

        if (request()->wantsJson()) {
            return SchoolResource::collection($schools);
        }

        return view('schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Schools $school)
    {
        return $school;
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
            'name'              => 'required|unique:schools|max:255|min:10', 
            'description'       => 'required|string', 
            'date_created'      => 'nullable|date',
            'states_id'         => 'required|exists:states,id',
            'lga_id'            => 'required|exists:lgas,id',
            'address'           => 'required', 
            'programme_id'    => 'required|exists:programmes,id', 
            'sponsored_id'      => 'required|exists:sponsoreds,id', 
            'jamb_points'       => 'nullable|integer',
            'phone'             => 'nullable|min:10|max:10', 
            'meta_description'  => 'required|string|min:140|max:150', 
            'hostels_accomodation'  => 'required|boolean', 
        ]);

        $school = Schools::create([
            'name'              => request('name'), 
            'short_name'        => request('short_name'), 
            'description'       => request('description'), 
            'date_created'      => request('date_created'),
            'website'           => request('website'), 
            'portal_website'    => request('portal_website'),
            'states_id'         => request('states_id'),
            'lga_id'            => request('lga_id'),
            'address'           => request('address'), 
            'programme_id'    => request('programme_id'), 
            'sponsored_id'      => request('sponsored_id'), 
            'phone'             => request('phone'), 
            'email'             => request('email'),
            'jamb_points'       => request('jamb_points'),
            'meta_description'  => request('meta_description'),
            'hostels_accomodation' => request('hostels_accomodation')
        ]);

        if (request()->wantsJson()) {
            return response($school, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(Schools $school)
    {
        $school->load(['posts' => function($query){
            $query->where('followup', true);
        },'photos','courses' => function($query)
            {$query->orderBy('name')->pluck('name')->take(20);
        }])->loadCount('courses');

        $relatedschools = Schools::where('programme_id', $school->programme_id)
            ->where('id', '!=', $school->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $school->increment('visits');
        return view('schools.show', compact(['school','relatedschools']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(Schools $school)
    {
        $photos = $school->photos()->get();
        
        return view('schools.create', compact('school','photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schools $school)
    {
        $request->validate([
            'name'              => 'required|max:255|min:10', 
            'description'       => 'nullable|string', 
            'date_created'      => 'nullable|date',
            'states_id'         => 'required|exists:states,id',
            'lga_id'            => 'required|exists:lgas,id',
            'address'           => 'required', 
            'programme_id'      => 'required|exists:programmes,id', 
            'sponsored_id'      => 'required|exists:sponsoreds,id', 
            'jamb_points'       => 'nullable|integer',
            'phone'             => 'nullable|min:10|max:10', 
            'meta_description'  => 'required|string|min:140|max:150', 
        ]);

        $school->name           = request('name'); 
        $school->short_name     = request('short_name'); 
        $school->description    = request('description'); 
        $school->date_created   = request('date_created');
        $school->website        = request('website'); 
        $school->portal_website = request('portal_website');
        $school->states_id      = request('states_id');
        $school->lga_id         = request('lga_id');
        $school->address        = request('address'); 
        $school->programme_id       = request('programme_id'); 
        $school->sponsored_id           = request('sponsored_id');
        $school->phone                  = request('phone'); 
        $school->email                  = request('email');
        $school->jamb_points            = request('jamb_points');
        $school->meta_description       = request('meta_description');
        $school->hostels_accomodation   = request('hostels_accomodation');

        $school->save();

        return $school;
    }

    public function openAdmission(Request $request, Schools $school) 
    {
        $request->validate([
            'ends_at'      => 'nullable|date',
        ]);

        $school->openAdmission($request->ends_at);

        return $school;
    }

    public function closeAdmission(Schools $school) 
    {
        $school->closeAdmission();

        return $school;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }

    public function getSchools($programme, $filters)
    {
        $schools = Schools::orderBy('name')->filter($filters);

        if ($programme->exists) {
            $schools->where('programme_id', $programme->id);
        }

        return $schools = $schools->paginate(20);
    }

    public function findschool(Request $request)
    {
        if ($request->filled('s') && $request->filled('sn')) {
             return Schools::where('name', 'LIKE', '%' . $request->s . '%')
                        ->orWhere('short_name', 'LIKE', '%' . $request->sn . '%')->get();
        }
        if ($request->filled('s')) {
            $schools = Schools::where('name', 'LIKE', '%' . $request->s . '%');
        }
        if ($request->filled('sn')) {
            $schools = Schools::where('short_name', 'LIKE', '%' . $request->sn . '%');
        }

        return $schools->get();
    }


    /**
     * Return the requirements needed to create a new schools
     */
    public function cschoolrequirements()
    {
        $Types = Programme::all();
        $Sponsored = Sponsored::all();
        $States = States::all();

        return compact('Types', 'Sponsored', 'States');
    }
}
