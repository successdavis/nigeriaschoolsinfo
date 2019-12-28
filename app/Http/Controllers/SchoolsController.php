<?php

namespace App\Http\Controllers;

use App\Filters\SchoolFilters;
use App\School;
use App\SchoolType;
use App\Schools;
use App\Http\Resources\SchoolResource;
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
            'name'          => 'required', 
            'description'   => 'required', 
            'date_created'  => 'date',
            // 'website'       => $faker->url, 
            // 'portal-website'=> $faker->url,
            'state'         => 'required',
            'lga'           => 'required',
            'address'       => 'required', 
            'school_type_id'   => 'required', 
            // 'phone'         => $faker->e164PhoneNumber, 
            // 'email'         => $faker->email
        ]);

        $school = Schools::create([
            'name'          => request('name'), 
            'description'   => request('description'), 
            'date_created'  => request('date_created'),
            'website'       => request('website'), 
            'portal-website'=> request('portal-website'),
            'state'         => request('state'),
            'lga'           => request('lga'),
            'address'       => request('address'), 
            'school_type_id'=> request('school_type_id'), 
            'phone'         => request('phone'), 
            'email'         => request('email')
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

        return $schools = $schools->paginate(25);
    }
}
