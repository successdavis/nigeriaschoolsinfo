<?php

namespace App\Http\Controllers;

use App\Schoolphoto;
use App\Repositories\ImageConverter;
use App\Schools;
use Illuminate\Http\Request;

class SchoolphotosController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','admin']);
    }
    
    public function index(Schools $schools) {
        return $schools->photos()->get();
    }

    public function store(Request $request, Schools $schools, ImageConverter $converter)
    {
		$request->validate([
            'caption'       => 'required|string',
            'description'   => 'required|string|max:240',
            'file'          => 'required|image'
        ]);

		$photo = new Schoolphoto;
        $photo->caption     = $request->caption;
        $photo->description = $request->description;
        $photo->schools_id  = $schools->id;
        $photo->save();

        $filename = $schools->slug . '-' 
        . str_replace(' ', '-', strtolower($request->caption));

        $path = $converter->convertImages('', $directory = 'schools/photos', $name = $filename);

        $photo->update([
            'url' => 'schools/photos/' . $filename . '-768px.webp', 'public'
        ]);

        return $photo->url;
    }

    public function destroy(Schoolphoto $photo)
    {
        $photo->delete();
        return response('Deleted', 200);
    }
}
