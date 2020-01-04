<?php

namespace App\Http\Controllers;

use App\Lga;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
    	$states = Lga::where('states_id', $request->local)->get();

    	return $states;
    }
}
