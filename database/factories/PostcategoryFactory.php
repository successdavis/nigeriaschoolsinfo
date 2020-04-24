<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Postcategory;
use Faker\Generator as Faker;

$factory->define(Postcategory::class, function (Faker $faker) {
    return [
        'title'				=> $faker->word,
        'description'		=> $faker->text,
        'meta_description'	=> $faker->sentence,
    ];
});
