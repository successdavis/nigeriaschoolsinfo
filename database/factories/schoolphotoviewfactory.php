<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schoolphoto;
use Faker\Generator as Faker;

$factory->define(Schoolphoto::class, function (Faker $faker) {
    return [
        "caption"		=> 'Front View of Unical', 
        "description"	=> 'Back View of Unical', 
        "schools_id"	=> function (){
        	return factory('App\Schools')->create()->id;
        },
        "url"			=> 'schoolphotos/some-image-title.jpg',
    ];
});
