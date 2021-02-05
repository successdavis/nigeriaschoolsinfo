<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\ImageConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostImageController extends Controller
{

    public function addimage(Request $request, ImageConverter $converter)
    {
        $this->authorize('create', new Post);
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $convertSizes = ['1920','1600','1366','1024','768','640'];
        $path = $converter->convertImages();
        //   "storePath" => "public/posts/145306344_904921300255896_8985664486606542574_o.webp",

        $srcset =  '';
        foreach ($convertSizes as $size) {
           $srcset = $srcset . asset('storage/posts/' . $converter->slugifyFileName() . '-' . $size .'px.webp') . ' ' . $size .'w,';
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
                'alt' => $converter->originalFileName(),
                'srcset' => $srcset,
                'sizes' => $sizes,
            ]);
    }

    public function store(Request $request, Post $post, ImageConverter $converter)
    {
        $this->authorize('updateFeaturedImage', $post);
        $request->validate([
            'file' => ['required', 'image']
        ]);

        $path = $converter->convertImages($sizes = ['320','64'], '', $name  =  $post->slug, '',  $saveOriginal = false);
        // posts/and-here-is-the-post-title-and-other-interesting-stuffs.jpg
        $post->update([
            'featured_image' => 'posts/' . $post->slug . '-64px.webp'
        ]);

        return response($post, 200);
    }
}
