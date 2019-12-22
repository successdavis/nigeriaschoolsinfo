<?php

namespace App\Http\Controllers;

use App\Schools;
use Illuminate\Http\Request;

class SchoolLogoController extends Controller
{
    public function store(Schools $school)
    {
    	$this->validate(request(), [
            'logo' => ['required', 'image']
        ]);

        $this->authorize('create', new Schools);

    	$school->update([
    		'logo_path' => request()->file('logo')->store('schools/logos', 'public')
    	]);

    	return response([], 204);
        exit;

    }
}
