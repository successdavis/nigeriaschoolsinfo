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

        $convertSizes = ['1920','1600','1366','1024','768','640','480'];

        // Intervention Convert into different sizes
        foreach ($convertSizes as $size) { 
            $storePath = $path . '-' .$size .'px' . $format;
            $img = Image::make(request()->file('file'))->resize($size, null, function($constraint){
                $constraint->aspectRatio();
            });
            Storage::put($storePath, (string) $img->encode('webp'));
        }

        // Return stored path to axios
        $path = 'posts/' . $newName . '-480px' . $format;

        $src =  asset('storage/'.$path);

        $srcset =  '';
        foreach ($convertSizes as $size) {
           $srcset = $srcset . asset('storage/posts/' . $newName . '-' . $size .'px' . $format) . ' ' . $size .'w,';
        }

        $sizes =  '';
        foreach ($convertSizes as $index => $size) {
            if ($index !== array_key_last($convertSizes)) {
                $sizes = $sizes . '(max-width: ' . $size . 'px) ' .$size . 'px,';
            }

            if ($index === array_key_last($convertSizes)) {
                $sizes = $sizes . '(max-width: ' . $size . 'px) ' .$size . 'px, 1024px';
            }
        }

        return response()
            ->json([
                'src' => $src,
                'alt' => $name,
                'srcset' => $srcset,
                'sizes' => $sizes,
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
