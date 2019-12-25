<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advertisements;
use Faker\Generator as Faker;

$factory->define(Advertisements::class, function (Faker $faker) {
    return [
        "name" 			=> $faker->name, 
        "image_path"	=> $faker->imageUrl($width = 640, $height = 480), 
        "primary_link"	=> $faker->url, 
        "secondary_link"=> $faker->url,
        "sypnosis"		=> $faker->sentence
    ];
});


$factory->state(Advertisements::class, 'active', function(Faker $faker) {
	return [
		'active' => true,
	];
});
