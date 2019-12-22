<?php

namespace App\Http\Controllers;

use App\Exams;
use Illuminate\Http\Request;

class ExamsLogoController extends Controller
{
    public function store(Exams $exams)
    {
    	$this->validate(request(), [
            'logo' => ['required', 'image']
        ]);

    	$exams->update([
    		'logo_path' => request()->file('logo')->store('exams/logos', 'public')
    	]);

    	return response([], 204);

    }
}
