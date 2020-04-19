<?php

namespace App\Http\Controllers;

use App\Advertisements;
use App\Post;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
    	$advertisements = Advertisements::activeAdverts();
    	$posts = Post::latest()->orderBy('visits', 'DESC')->limit(10)->get();

    	return view('welcome', compact('advertisements','posts'));
    }
}
