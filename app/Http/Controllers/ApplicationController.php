<?php

namespace App\Http\Controllers;

use App\Advertisements;
use App\Post;
use App\Job;
use App\Project;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
    	$advertisements = Advertisements::activeAdverts();
    	$posts = Post::latest()->orderBy('visits', 'DESC')->limit(10)->get();
    	$projects = Project::latest()->orderBy('visits', 'DESC')->limit(10)->get();
    	$jobs = Job::latest()->limit(20)->get();

    	return view('welcome', compact('advertisements','posts','projects','jobs'));
    }
}
