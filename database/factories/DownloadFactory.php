<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Download;
use Faker\Generator as Faker;

$factory->define(Download::class, function (Faker $faker) {
    return [
        'user_id' 		=> function () {
        	return factory('App\User')->create()->id;
        },
        'payment_id'	=> function (){
        	return factory('App\Payment')->create()->id;
        },
        'download_id'	=> function () {
        	return factory('App\Project')->create()->id;
        },
        'download_type'	=> 'App\Project'
    ];
});
