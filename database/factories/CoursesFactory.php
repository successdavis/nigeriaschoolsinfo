<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Courses;
use Faker\Generator as Faker;

$factory->define(Courses::class, function (Faker $faker) {
    return [
        'name' 			=> $faker->sentence,
        'description'	=> 'the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog ',
        'short_name'	=> $faker->word,
        'salary'		=> 200000,
		'faculty_id'=> function(){
            return factory('App\Faculty')->create()->id;
        },
        'duration'  => 3,
        'utme_comment'	=> 'plus any Social Science subject.',
        'utme_requirement'	=> 'the other two relevant subjectscould be from any of Accounting, Principles of Accounts, Commerce, Office  Practice and Secretarial Duties. .',
        'direct_requirement' => 'Two a level passes chosen from Economics, Accounting, Business Management, Government and Geography',
    ];
});
