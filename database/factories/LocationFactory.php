<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\States;
use App\Lga;
use Faker\Generator as Faker;

$factory->define(States::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(Lga::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'states_id' => function(){
            return factory('App\States')->create()->id;
        }, 
    ];
});
