<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body'		=> $faker->paragraph,
        'commentable_type'	=> 'App\Post',
        'user_id'	=> function() {
        	return factory('App\User')->create()->id;
        },
        'commentable_id'	=> function() {
        	return factory('App\Post')->create()->id;
        }
    ];
});
