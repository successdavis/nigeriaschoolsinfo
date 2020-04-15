<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projectcategory;
use Faker\Generator as Faker;

$factory->define(Projectcategory::class, function (Faker $faker) {
    return [
        'title'			=> $faker->sentence,
        'description'	=> $faker->paragraph,
    ];
});
