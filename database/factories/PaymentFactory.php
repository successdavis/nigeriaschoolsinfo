<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
    	"amount"			=> 3000, 
    	"method"			=> 'Master Card', 
    	"description"		=> 'Payment for Project', 
    	"transaction_ref"	=> '23232h2iuig4', 
    	'billable_id'		=> function(){
    		return factory('App\Project')->create()->id;
    	}, 
    	'billable_type'		=> 'App\Project',
        'user_id'           => function(){
            return factory('App\User')->create()->id;
        }
    ];
});
