<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostImageController extends Controller
{
   
    public function addimage(Request $request)
    {
        $this->authorize('create', new Post);
        
        $request->validate([
            'file' => ['required', 'image']
        ]);

        // Get the actual filename without extension
        $name = pathinfo(request()->file('file')->getClientOriginalName(), PATHINFO_FILENAME);

        // replace spaces with hyphen (-)
        $newName = str_replace(' ', '-', $name);

        // The path and format to store the image
        $path = 'public/posts/' . $newName;
        $format = '.webp';
        $storePath = $path . '-1920px' . $format;

        // Intervention Resize to 1920
        $img = Image::make(request()->file('file'))->resize(1920, null, function($constraint){
            $constraint->aspectRatio();
        });
        // Store the image to public storage posts directory
        Storage::put($storePath, (string) $img->encode('webp'));

        // Convert and store in 1600
        $storePath = $path . '-1600px' . $format;
        $img = Image::make(request()->file('file'))->resize(1600, null, function($constraint){
            $constraint->aspectRatio();
        });
        Storage::put($storePath, (string) $img->encode('webp'));


        // Convert and store in 1366
        $storePath = $path . '-1366px' . $format;
        $img = Image::make(request()->file('file'))->resize(1366, null, function($constraint){
            $constraint->aspectRatio();
        });
        Storage::put($storePath, (string) $img->encode('webp'));


        // Convert and store in 1024
        $storePath = $path . '-1024px' . $format;
        $img = Image::make(request()->file('file'))->resize(1024, null, function($constraint){
            $constraint->aspectRatio();
        });
        Storage::put($storePath, (string) $img->encode('webp'));


        // Convert and store in 768
        $storePath = $path . '-768px' . $format;
        $img = Image::make(request()->file('file'))->resize(768, null, function($constraint){
            $constraint->aspectRatio();
        });
        Storage::put($storePath, (string) $img->encode('webp'));



        // Convert and store in 640
        $storePath = $path . '-640px' . $format;
        $img = Image::make(request()->file('file'))->resize(640, null, function($constraint){
            $constraint->aspectRatio();
        });
        Storage::put($storePath, (string) $img->encode('webp'));

        // Return stored path to axios
        $path = 'posts/' . $newName . '-768px' . $format;

        $src =  asset('storage/'.$path);

        $srcset =   asset('storage/'.$path) . " 768w," .
                    asset('storage/posts/' . $newName . '-1600px' . $format) . " 1600w," .
                    asset('storage/posts/' . $newName . '-1366px' . $format) . " 1366w," .
                    asset('storage/posts/' . $newName . '-1024px' . $format) . " 1024w," .
                    asset('storage/posts/' . $newName . '-768px' . $format) . " 768w," .
                    asset('storage/posts/' . $newName . '-640px' . $format) . " 640w";

        return response()
            ->json([
                'src' => $src,
                'alt' => $name,
                'srcset' => $srcset,
                'sizes' => "(max-width: 1600px) 1600px, 
                (max-width: 1366px) 1366px, 
                (max-width: 1024px) 1024px, 
                (max-width: 768px) 768px,
                (max-width: 640px) 640px, 1600px"
            ]);
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('updateFeaturedImage', $post);
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $name = $post->slug .'.'.request()->file('file')->getClientOriginalExtension();

        $post->update([
            'featured_image' => request()->file('file')->storeAs('posts', $name, 'public')
        ]);

        return response($post, 200);
    }
}
