<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Filters\CourseFilters;
use App\Http\Resources\CourseResource;
use App\Http\Resources\SchoolResource;
use App\Schools;
use Illuminate\Http\Request;

class CourseSchoolAttachmentController extends Controller
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
        $request->validate([
            'course' => 'required|integer',
            'school' => 'required|integer',
            'cut_off_points' => 'nullable|integer'
        ]);

        $course = Courses::findOrFail($request->course);
        $course->attachSchool($request->school, $request->cut_off_points);

        return Response(201);
    }

    public function storeManySchools(Courses $course, Request $request)
    {
        $course->schools()->attach($request->schools);

        return Response(201);
    }

    public function storeManyCourses(Schools $schools, Request $request)
    {
        $schools->courses()->attach($request->courses);

        return Response(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Courses::findOrFail($request->course);
        $course->detachSchool($request->school);

        return Response(201);
    }

    public function courses(Schools $schools, CourseFilters $filters)
    {
        request()->validate([
            's'         => 'nullable|string',
            'faculty'   => 'nullable|string'
        ]);
        $courses = Courses::latest()->filter($filters);

        $courses = $courses->paginate(50);

        foreach ($courses as $course) {
            $course['is_link'] = $course->schoolRelationship($schools->id);
        }

        return $courses;

    }


    public function getNotLinkedSchools(Courses $course)
    {
        $schooltype = request('type');

        $schools =  Schools::whereDoesntHave('courses', function($q) use ($course) {
            $q->where('courses_id', $course->id);
        })->orderBy('name');

        if ($schooltype) {
            $schools->where('school_type_id', $schooltype->id);
        }

        $schools = $schools->paginate(20);

        if (request()->wantsJson()) {
            return SchoolResource::collection($schools);
        }
    }

    public function getLinkedSchools(Courses $course)
    {
        $schooltype = request('type');

        $schools = $course->schools()->orderBy('name');

        if ($schooltype) {
            $schools->where('school_type_id', $schooltype->id);
        }

        $schools = $schools->paginate(20);

        if (request()->wantsJson()) {
            return SchoolResource::collection($schools);
        }
    }

    public function getNotLinkedCourses(Schools $school)
    {
        $courses = Courses::whereDoesntHave('schools', function($q) use ($school) {
            $q->where('schools_id', $school->id);
        })->orderBy('name');

        $courses = $courses->paginate(20);

        if (request()->wantsJson()) {
            return CourseResource::collection($courses);
        }   
    }

    public function getLinkedCourses(Schools $school)
    {

        $courses = $school->courses()->orderBy('name');

        $courses = $courses->paginate(20);

        if (request()->wantsJson()) {
            return CourseResource::collection($courses);
        }   

        return view('schools.coursesoffered', compact('courses','school'));
    }
}
