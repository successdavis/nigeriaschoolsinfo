<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Faculty;
use App\Filters\CourseFilters;
use App\Http\Resources\CourseResource;
use App\Schools;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Schools $schools, CourseFilters $filters)
    {
        $courses = $this->getCourses($schools, $filters);

        if (request()->wantsJson()) {
            return CourseResource::collection($courses);
        }
        $faculties = Faculty::all();
        return view('courses.index', compact('courses', 'faculties'));
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
            'name'            => 'required|unique:courses|max:255|min:10',
            'description'     => 'required|min:300', 
            'faculty_id'      => 'required|exists:faculties,id',
            'salary'          => 'integer', 
            'duration'          => 'integer', 


        ]);
        $course = Courses::create([
            'name'              =>  $request->name,
            'short_name'        =>  $request->short_name,
            'faculty_id'        =>  $request->faculty_id,
            'description'       =>  $request->description,
            'salary'            =>  $request->salary,
            'duration'          =>  $request->duration,
        ]);

        if (request()->wantsJson()) {
            return response($course, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $courses)
    {
        return view('courses.show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $courses)
    {
        //
    }

    public function getCourses($schools, $filters)
    {
        $courses = Courses::latest()->filter($filters);
        if ($schools->exists) {
            $courses = $schools->courses();
        }

        return $courses = $courses->paginate(25);
    }

    public function findcourses(Request $request)
    {
         if ($request->filled('name') && $request->filled('short_name')) {
             return Courses::where('name', 'LIKE', '%' . $request->name . '%')
                ->orWhere('short_name', 'LIKE', '%' . $request->short_name . '%')->get();
        }
        if ($request->filled('name')) {
            return Courses::where('name', 'LIKE', '%' . $request->name . '%')->get();
        }
        if ($request->filled('short_name')) {
            return Courses::where('short_name', 'LIKE', '%' . $request->short_name . '%')->get();
        }

        return [];
    }

    public function getschools(Courses $course, Request $request)
    {
        if ($request->selected == 'attached') {
            return $course->schools;
        }

        $modules = Schools::whereDoesntHave('courses', function($q) use ($course){
            $q->where('courses_id', $course->id);
        })->get();

        return $modules;
    }
}
