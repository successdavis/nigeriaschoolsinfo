<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        "title"				=> $faker->sentence, 
        "description"		=> $faker->text, 
        "portal_website" 	=> $faker->url,
        "ends_at"			=> $faker->dateTime($max = 'now', $timezone = null), 
        "phone" 			=> $faker->e164PhoneNumber,
        "location"			=> '#1 Hospital Lane Obudu',
        "employer"			=> 'S-Techmax',
        "user_id"			=> function () {
        	return factory('App\User')->create()->id;
        },
    ];
});
