<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consideration;
use Faker\Generator as Faker;

$factory->define(Consideration::class, function (Faker $faker) {
    return [
        'consideration' => $faker->paragraph,
        'course_id' => function(){
            return factory('App\Courses')->create()->id;
        },
    ];
});
