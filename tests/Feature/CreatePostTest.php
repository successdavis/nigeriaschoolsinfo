<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreatePostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_administrator_can_publish_a_new_post()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);
        $school = create('App\Schools');


        $post = make('App\Post');

        $response = $this->json('POST', '/posts/publishpost', [
            'module_id' => $school->id, 
            'title'     => $post->title, 
            'body'      => $post->body,
            'module'    => 'Schools'
        ])->json();
        
        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    /** @test */
    public function a_title_is_required_to_create_a_post()
    {
        $this->withExceptionHandling();
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);
        $school = create('App\Schools');

        $user->assignRole($role->id);
        $this->signIn($user);

        $post = make('App\Post');

        $response = $this->json('POST', '/posts/publishpost', [
            'module_id' => $school->id, 
            'body'      => $post->body,
            'module'    => 'Schools'
        ]);
        
        $this->assertDatabaseMissing('posts', ['title' => $post->title]);
    }
}
