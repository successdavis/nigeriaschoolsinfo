<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        "title"				=> $faker->word, 
        "description"		=> 'the quick brown fox jumps over the lazy dog and the lazy dog chase after it and so the story keeps going on and on and on', 
        "portal_website" 	=> $faker->url,
        "ends_at"			=> $faker->dateTime($max = 'now', $timezone = null), 
        "phone" 			=> $faker->e164PhoneNumber,
        "location"			=> '#1 Hospital Lane Obudu',
        "employer"			=> 'S-Techmax',
        "user_id"			=> function () {
        	return factory('App\User')->create()->id;
        },
        'meta_description'  => 'Nullam cursus lacinia erat. Praesent blandit laoreet nibh. Phasellus blandit leo ut odio.Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Sed a libero.'
    ];
});
