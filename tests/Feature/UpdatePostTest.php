<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdatePostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = create('App\Post');
    }

    /** @test */
    public function an_admin_can_update_a_post()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $this->json('patch', '/posts/updatepost/' . $this->post->slug, [
            'title'     => 'hello world', 
            'body'      => 'The quick brown fox',
            'module'    => $this->post->source_type,
            'module_id' => $this->post->source_id
        ])->json();

        $this->assertEquals($this->post->fresh()->title, 'hello world');
    }

    /** @test */
    public function an_admin_can_update_post_category_and_related_model()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $course = create('App\Courses');

        $this->json('patch', '/posts/updatepost/' . $this->post->slug, [
            'title'       => 'hello world', 
            'body'        => 'The quick brown fox',
            'module'      => 'Courses',
            'module_id'   => '1'
        ])->json();

        $this->assertInstanceOf("App\Courses", $this->post->fresh()->source);
    }
}
