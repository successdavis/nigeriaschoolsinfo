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
        'utme_comment'	=> 'plus any Social Science subject.',
        'utme_requirement'	=> 'Five SSCE credit passes including English Language, Mathematics, Economics and any other two relevant subjects. For NBC holders, the other two relevant subjectscould be from any of Accounting, Principles of Accounts, Commerce, Office  Practice and Secretarial Duties. .',
        'direct_requirement' => 'Two ‘A’ level passes chosen from Economics, Accounting, Business Management, Government and Geography',
    ];
});
