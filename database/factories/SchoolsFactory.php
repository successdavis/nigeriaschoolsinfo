<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schools;
use App\SchoolType;
use Faker\Generator as Faker;

$factory->define(Schools::class, function (Faker $faker) {
    return [
        'name'              => $faker->name, 
        'short_name'        => $faker->word, 
        'description'       => $faker->paragraph, 
        'date_created' 	    => $faker->date($format = 'Y-m-d', $max = 'now'),
        'website'           => $faker->url, 
        'portal_website'    => $faker->url,
        'states_id'			=> function(){
            return factory('App\States')->create()->id;
        },
        'lga_id'			    => function(){
            return factory('App\Lga')->create()->id;
        },
        'address'           => $faker->streetAddress, 
        'school_type_id'    => function(){
            return factory('App\SchoolType')->create()->id;
        }, 
        'phone'             => $faker->e164PhoneNumber, 
        'sponsored_id'      => function(){
            return factory('App\Sponsored')->create()->id;
        }, 
        'email'             => $faker->email
    ];
});

$factory->define(SchoolType::class, function (Faker $faker) {
    return [
        'name'              => $faker->name, 
        'description'       =>  $faker->sentence,
    ];
});
