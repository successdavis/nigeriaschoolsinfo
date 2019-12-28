<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsored;
use Faker\Generator as Faker;

$factory->define(Sponsored::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
