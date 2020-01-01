<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;

class FacultiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculties  $faculties
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        $courses = $faculty->courses;
        return view('faculties.show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculties  $faculties
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculties  $faculties
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculties $faculties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculties  $faculties
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculties $faculties)
    {
        //
    }
}
