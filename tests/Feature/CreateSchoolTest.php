<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateSchoolTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->school = create('App\Schools');
    }

    /** @test */
    public function an_administrator_can_creat_a_new_school()
    {   
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $school = make('App\Schools');

        $this->json('post', route('schools.store'), $school->toArray())
            ->assertStatus(201);
    }

    /** @test */
    public function only_an_admin_can_create_a_new_school()
    {   
        $this->withExceptionHandling();
        $user = create('App\User');
        $role = create('App\Role', ['name' => 'publisher']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $school = make('App\Schools');

        $this->json('post', route('schools.store'), $school->toArray())
            ->assertStatus(403);
    }



    /** @test */
    public function a_school_requires_a_unique_slug()
    {
        $this->signIn();

        $school = create('App\Schools', ['name' => 'Foo Title']);

        $this->assertEquals($school->fresh()->slug, 'foo-title');
    }
}
