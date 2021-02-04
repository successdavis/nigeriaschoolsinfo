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

        $convertSizes = ['1920','1600','1366','1024','768','640'];
        $path = $this->converImages();
        //   "storePath" => "public/posts/145306344_904921300255896_8985664486606542574_o.webp",

        $srcset =  '';
        foreach ($convertSizes as $size) {
           $srcset = $srcset . asset('storage/posts/' . $this->slugifyFileName() . '-' . $size .'px.webp') . ' ' . $size .'w,';
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
                'src' => asset('storage/'.$path),
                'alt' => $this->originalFileName(),
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

        $path = $this->converImages($sizes = ['320','64'], '', $name  =  $post->slug, '',  $saveOriginal = false);
        // posts/and-here-is-the-post-title-and-other-interesting-stuffs.jpg
        $post->update([
            'featured_image' => 'posts/' . $post->slug . '-320px.webp'
        ]);

        return response($post, 200);
    }

    public function converImages($sizes = [], $directory = null, $name = '', $format = '', $saveOriginal = true ) 
    {
        $newName = $name ?: $this->slugifyFileName();
        
        // Check if a directory was given else assign a default
        $directory = $directory ?: 'posts';
        // The path and format to store the image
        $path = 'public/' . $directory .'/' . $newName;
        // 'public/' . $directory ? $directory : 'posts' .'/' . $newName
        $format = $format ?: '.webp';

        $convertSizes = $sizes ?: ['1920','1600','1366','1024','768','640'];

        if ($saveOriginal) {
            // Convert and store image in its original width
            $storePath = $path . $format;
            $img = Image::make(request()->file('file'));
            Storage::put($storePath, (string) $img->encode('webp'));
        }

        // Intervention Convert image into different sizes
        foreach ($convertSizes as $size) { 
            $storePath = $path . '-' .$size .'px' . $format;
            $img = Image::make(request()->file('file'))->resize($size, null, function($constraint){
                $constraint->aspectRatio();
            });
            Storage::put($storePath, (string) $img->encode('webp'));
        }

        // Return stored path to axios
        return $storePath = $path . $format;
    }

    protected function slugifyFileName() {
        // Get the actual filename without extension
        $filename = $this->originalFileName();
        // replace spaces with hyphen (-)
        $slugifyName = str_replace(' ', '-', $filename);

        return $slugifyName;
    }

    protected function originalFileName() {
        return $filename = pathinfo(request()->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
    }
}
