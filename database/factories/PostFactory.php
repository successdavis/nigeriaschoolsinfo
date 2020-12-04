<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' 		=> 'the quick brown fox jumps over the lazy dog and the',
        'body' 			=> $faker->paragraph,
        'source_type' 	=> 'App\Schools',
        'locked'        => false,
        'visits'        => 0,
        'followup'      => false,
        'source_id'		=> function() {
            return factory('App\Schools')->create()->id;
        },
        'user_id'     => function() {
            return factory('App\User')->create()->id;
        },
        'meta_description' => 'Proin faucibus arcu quis ante. Morbi mattis ullamcorper velit. Curabitur a felis in nunc fringilla tristique. Suspendisse enim turpis, dictum sed, '
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

$factory->state(Post::class, 'course', function (Faker $faker) {
    return [
        'source_type'   => 'App\Courses',
        'source_id'     => function() {
            return factory('App\Courses')->create()->id;
        },
    ];
});

$factory->state(Post::class, 'category', function (Faker $faker) {
    return [
        'source_type'    => 'App\Postcategory',
        'featured_image' => $faker->image('public/storage/posts',400,300,null,false),
        'source_id'      => function() {
            return factory('App\Postcategory')->create()->id;
        },
    ];
});
