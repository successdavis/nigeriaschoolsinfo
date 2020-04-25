<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title'			=> $faker->sentence,
        'description'	=> $faker->paragraph,
        'user_id'		=> function () {
        	return factory('App\User')->create()->id;
        },
        'course_id'	=> function () {
        	return factory('App\Courses')->create()->id;
        },
        'schooltype_id'	=> function () {
        	return factory('App\SchoolType')->create()->id;
        },
        'amount'		=> 2000,
        'visits'        => 0,
        'download_path' => 'projects/et-deleniti-et-non-id-ut-magni.docx'
    ];
});
