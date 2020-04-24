<?php

namespace App\Http\Controllers;

use App\Postcategory;
use Illuminate\Http\Request;

class PostcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Postcategory::all();

        return $categories;
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
            'title'             => 'required|string',
            'description'       => 'required|string',
            'meta_description'  => 'required|string'
        ]);

        $category = new Postcategory;
        $category->title            = $request->title;
        $category->description      = $request->description;
        $category->meta_description = $request->meta_description;

        $category->save();

        if (request()->wantsJson()) {
            return $category;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postcategory  $postcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Postcategory $category)
    {
        $posts = $category->posts()->paginate(50);
        
        return view('postcategories.show', compact('category','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postcategory  $postcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Postcategory $postcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postcategory  $postcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postcategory $postcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postcategory  $postcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postcategory $postcategory)
    {
        //
    }
}
