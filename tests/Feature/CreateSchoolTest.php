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
        $admin = $this->signIn(factory('App\User')->states('administrator')->create());

        $school = make('App\Schools');

        // dd($school);

        $this->json('post', route('schools.store'), $school->toArray())
            ->assertStatus(201);
    }

    /** @test */
    public function a_school_requires_a_unique_slug()
    {
        $this->signIn();

        $school = create('App\Schools', ['name' => 'Foo Title']);

        $this->assertEquals($school->fresh()->slug, 'foo-title');

        // $School = $this->postJson(route('posts.save'), $post->toArray())->json();

        // $this->assertEquals("foo-title-{$post['id']}", $post['slug']);
    }
}
