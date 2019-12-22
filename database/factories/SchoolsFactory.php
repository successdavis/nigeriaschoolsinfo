<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schools;
use Faker\Generator as Faker;

$factory->define(Schools::class, function (Faker $faker) {
    return [
        'name' 			=> $faker->name, 
        'description'	=> $faker->paragraph, 
        'date_created' 	=> $faker->date($format = 'Y-m-d', $max = 'now'),
        // 'logo_path'		=> $faker->imageUrl, 
        'website'		=> $faker->url, 
        'portal-website'=> $faker->url,
        'state'			=> '1',
        'lga'			=> '2',
        'address'		=> $faker->streetAddress, 
        'type'			=> 'University', 
        'phone'			=> $faker->e164PhoneNumber, 
        'email'			=> $faker->email
    ];
});
