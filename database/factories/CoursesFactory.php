<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Courses;
use Faker\Generator as Faker;

$factory->define(Courses::class, function (Faker $faker) {
    return [
        'name' 			=> $faker->name,
        'description'	=> $faker->sentence,
        'short_name'	=> $faker->word,
        'salary'		=> 200000,
    ];
});
