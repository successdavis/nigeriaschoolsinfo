<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageConverter 
{
	public function convertImages($sizes = [], $directory = null, $name = '', $format = '', $saveOriginal = true ) 
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

    public function slugifyFileName() {
        // Get the actual filename without extension
        $filename = $this->originalFileName();
        // replace spaces with hyphen (-)
        $slugifyName = str_replace(' ', '-', $filename);

        return $slugifyName;
    }

    public function originalFileName() {
        return $filename = pathinfo(request()->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
    }
}