<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateCourseTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Courses');
    }

        /** @test */
    public function an_administrator_can_creat_a_new_course()
    {   
        $this->withExceptionHandling();
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $course = make('App\Courses');

        $this->json('post', route('courses.store'), $course->toArray())
            ->assertStatus(201);
    }
}
