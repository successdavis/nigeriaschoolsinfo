<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schools;
use App\SchoolType;
use Faker\Generator as Faker;

$factory->define(Schools::class, function (Faker $faker) {
    return [
        'name'              => $faker->sentence, 
        'short_name'        => $faker->word, 
        'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
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
        'phone'             => '9050635733', 
        'sponsored_id'      => function(){
            return factory('App\Sponsored')->create()->id;
        }, 
        'email'             => $faker->email,
        'jamb_points'       => '120'
    ];
});

$factory->define(SchoolType::class, function (Faker $faker) {
    return [
        'name'              => $faker->name, 
        'description'       =>  $faker->sentence,
    ];
});
