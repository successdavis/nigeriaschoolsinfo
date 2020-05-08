<?php

namespace App\Http\Controllers;

use App\Schoolphoto;
use App\Schools;
use Illuminate\Http\Request;

class SchoolphotosController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','admin']);
    }
    
    public function store(Request $request, Schools $schools)
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

        $name = $schools->slug . '-' 
        . str_replace(' ', '-', strtolower($request->caption))
        .'.'.request()->file('file')->getClientOriginalExtension();

        $photo->update([
            'url' => request()->file('file')->storeAs('schools/photos', $name, 'public')
        ]);

        return asset('storage/' . $photo->url);
    }

    public function destroy(Schoolphoto $photo)
    {
        $photo->delete();
        return response('Deleted', 200);
    }
}
