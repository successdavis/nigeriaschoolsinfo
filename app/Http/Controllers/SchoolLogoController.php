<?php

namespace App\Http\Controllers;

use App\Schools;
use Illuminate\Http\Request;
use App\Repositories\ImageConverter;


class SchoolLogoController extends Controller
{
    public function store(Request $request, Schools $school, ImageConverter $converter)
    {
    	$this->validate(request(), [
            'file' => ['required', 'image']
        ]);

        $this->authorize('create', new Schools);

        // convertImages($sizes = [], $directory = null, $name = '', $format = '', $saveOriginal = true )
        $path = $converter->convertImages(['640','240'], $directory = 'schools/logos');

    	$school->update([
    		'logo_path' => 'schools/logos/' . $converter->slugifyFileName() . '-240px.webp'
    	]);

    	return response([], 204);
        exit;

    }
}
