<?php

namespace App\Http\Controllers;

use App\Filters\SchoolFilters;
use App\Http\Resources\SchoolResource;
use App\School;
use App\SchoolType;
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
    public function index(SchoolType $schooltype, SchoolFilters $filters)
    {
        $schools = $this->getSchools($schooltype, $filters);

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
            'name'              => 'required|unique:schools|max:255|min:10', 
            'description'       => 'required|min:300', 
            'date_created'      => 'nullable|date',
            'states_id'         => 'required|exists:states,id',
            'lga_id'            => 'required|exists:lgas,id',
            'address'           => 'required', 
            'school_type_id'    => 'required|exists:school_types,id', 
            'sponsored_id'      => 'required|exists:sponsoreds,id', 
            'jamb_points'       => 'integer',
            'phone'             => 'min:10|max:10', 
        ]);

        $school = Schools::create([
            'name'          => request('name'), 
            'description'   => request('description'), 
            'date_created'  => request('date_created'),
            'website'       => request('website'), 
            'portal_website'=> request('portal_website'),
            'states_id'      => request('states_id'),
            'lga_id'        => request('lga_id'),
            'address'       => request('address'), 
            'school_type_id'=> request('school_type_id'), 
            'sponsored_id'  => request('sponsored_id'), 
            'phone'         => request('phone'), 
            'email'         => request('email'),
            'jamb_points'         => request('jamb_points')
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
        return view('schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
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

    public function getSchools($schooltype, $filters)
    {
        $schools = Schools::latest()->filter($filters);

        if ($schooltype->exists) {
            $schools->where('school_type_id', $schooltype->id);
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

    public function cschoolrequirements()
    {
        $Types = SchoolType::all();
        $Sponsored = Sponsored::all();
        $States = States::all();

        return compact('Types', 'Sponsored', 'States');
    }
}
