<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exams;
use Faker\Generator as Faker;

$factory->define(Exams::class, function (Faker $faker) {
    return [
        'name' 			=> $faker->name, 
        'short_name'    => $faker->word, 
        'description'	=> $faker->paragraph, 
        'sypnosis'      => 'The quick brown fox jumps over the lazy dog and the lazy dog chase after it',
        'date_created' 	=> $faker->date($format = 'Y-m-d', $max = 'now'),
        'website'		=> $faker->url, 
        'portal-website'=> $faker->url,
        'phone'			=> $faker->e164PhoneNumber, 
        'email'			=> $faker->email
    ];
});
