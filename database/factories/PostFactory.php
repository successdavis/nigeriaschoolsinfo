<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' 		=> $faker->name,
        'body' 			=> $faker->paragraph,
        'source_type' 	=> 'App\Schools',
        'locked'        => false,
        'source_id'		=> function() {
            return factory('App\Schools')->create()->id;
        },
        'user_id'     => function() {
            return factory('App\User')->create()->id;
        },
    ];
});

$factory->state(Post::class, 'exams', function (Faker $faker) {
    return [
        'source_type' 	=> 'App\Exams',
        'source_id'		=> function() {
            return factory('App\Exams')->create()->id;
        },
    ];
});
