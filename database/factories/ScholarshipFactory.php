<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Scholarship;
use Faker\Generator as Faker;

$factory->define(Scholarship::class, function (Faker $faker) {
    return [
        "title"				=> $faker->sentence, 
        "description"		=> 'the quick brown fox jumps over the lazy dog and the lazy dog chase after it and so the story keeps going on and on and on', 
        "portal_website" 	=> $faker->url,
        "ends_at"			=> $faker->dateTime($max = 'now', $timezone = null), 
        "institution" 			=> $faker->e164PhoneNumber,
        "location"			=> '#1 Hospital Lane Obudu',
        "user_id"			=> function () {
        	return factory('App\User')->create()->id;
        },
    ];
});
