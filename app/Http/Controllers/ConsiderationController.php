<?php

namespace App\Http\Controllers;

use App\Consideration;
use App\Courses;
use Illuminate\Http\Request;

class ConsiderationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Courses $course, Request $request)
    {
        $considerations = $course->considerations()->get();

        return $considerations;
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
    public function store(Courses $course, Request $request)
    {
        $consideration = $course->considerations()->create([
            'consideration' => $request->consideration,
        ]);

        return $consideration;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consideration  $consideration
     * @return \Illuminate\Http\Response
     */
    public function show(Consideration $consideration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consideration  $consideration
     * @return \Illuminate\Http\Response
     */
    public function edit(Consideration $consideration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consideration  $consideration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consideration $consideration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consideration  $consideration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consideration $consideration)
    {
        $consideration->delete();

        return Response(200);
    }
}
