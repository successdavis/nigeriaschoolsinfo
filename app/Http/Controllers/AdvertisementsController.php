<?php

namespace App\Http\Controllers;

use App\Advertisements;
use Illuminate\Http\Request;

class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advertisements::activeAdverts();

        if (request()->wantsJson()) {
            return $adverts;
        }

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
     * @param  \App\Advertisements  $advertisements
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisements $advertisements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertisements  $advertisements
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisements $advertisements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertisements  $advertisements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisements $advertisements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisements  $advertisements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisements $advertisements)
    {
        //
    }
}
