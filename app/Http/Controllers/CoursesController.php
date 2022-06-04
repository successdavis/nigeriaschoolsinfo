<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Faculty;
use App\Filters\CourseFilters;
use App\Http\Resources\CourseIndexPageResource;
use App\Programme;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Programme $programme, CourseFilters $filters)
    {
        $courses = $this->getCourses($programme, $filters);

        if (request()->wantsJson()) {
            return CourseIndexPageResource::collection($courses);
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
        $this->authorize('create', new Courses);
        $request->validate([
            'name'                  => 'required|unique:courses|max:200|min:5',
            'description'           => 'required',
            'faculty_id'            => 'required|exists:faculties,id',
            'salary'                => 'required|integer',
            'duration'              => 'required|integer',
            'utme_comment'          => 'nullable|string|max:250',
            'utme_requirement'      => 'nullable|string',
            'direct_requirement'    => 'nullable|string',
            'considerations'        => 'nullable|string',
            'selectedprogrammes'    => 'required|array'
        ]);

        // dd(request()->all());
        $course = Courses::create([
            'name'              =>  $request->name,
            'short_name'        =>  $request->short_name,
            'faculty_id'        =>  $request->faculty_id,
            'description'       =>  $request->description,
            'salary'            =>  $request->salary,
            'duration'          =>  $request->duration,
            'utme_comment'          =>  $request->utme_comment,
            'utme_requirement'      =>  $request->utme_requirement,
            'direct_requirement'    =>  $request->direct_requirement,
            'considerations'        =>  $request->considerations,
            'cut_off_point'        =>  $request->cut_off_point,
        ]);

        $course->programmes()->attach($request->selectedprogrammes);

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
        $courses->increment('visits');
        $courses->with(['schools'])->limit(50)->get();

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
        $this->authorize('update', $course);

        return new CourseIndexPageResource($course);
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
        $this->authorize('update', $courses);

        $this->authorize('create', new Courses);
        $request->validate([
            'name'                  => 'required|max:200|min:5',
            'description'           => 'required',
            'faculty_id'            => 'required|exists:faculties,id',
            'salary'                => 'required|integer',
            'duration'              => 'required|integer',
            'utme_comment'          => 'nullable|string|max:250',
            'utme_requirement'      => 'nullable|string',
            'direct_requirement'    => 'nullable|string',
            'considerations'        => 'nullable|string',
            'cut_off_point'         => 'nullable|integer'
        ]);

        // dd(request()->all());
        $courses->update([
            'name'              =>  $request->name,
            'short_name'        =>  $request->short_name,
            'faculty_id'        =>  $request->faculty_id,
            'description'       =>  $request->description,
            'salary'            =>  $request->salary,
            'duration'          =>  $request->duration,
            'utme_comment'          =>  $request->utme_comment,
            'utme_requirement'      =>  $request->utme_requirement,
            'direct_requirement'    =>  $request->direct_requirement,
            'considerations'        =>  $request->considerations,
            'cut_off_point'        =>  $request->cut_off_point,
        ]);

        if (request()->wantsJson()) {
            return response($courses, 201);
        }

    }

    public function getCourses($programme, $filters)
    {
//        $courses = DB::table('courses')->orderBy('name', 'asc')->select('name','duration','salary')->filter($filters);

        $courses = Courses::orderBy('name')->select('name','description','salary','duration','slug')->filter($filters);

        if ($programme->exists) {
            $courses = $programme->courses();
        }

        return $courses = $courses->paginate(50);
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

    public function getrequirements()
    {
        $faculties = Faculty::all();
        $subjects =  Subject::all();

        return compact('faculties', 'subjects');
    }

    public function getschools(Courses $course)
    {
        $schools = $course->schools()->orderBy('name')->get();

        return view('courses.schools', compact('course','schools'));
    }
}
