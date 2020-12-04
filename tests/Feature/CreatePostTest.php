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
        $post = $this->savepost();

        $dbpost = \App\Post::first();

        $dbpost->publish();

        $this->assertTrue($dbpost->published);
    }

    /** @test */
    public function an_administrator_can_upublish_a_new_post()
    {
        $post = $this->savepost();

        $dbpost = \App\Post::first();

        $dbpost->unpublish();

        $this->assertFalse($dbpost->published);
    }

    /** @test */
    public function an_administrator_can_save_a_post()
    {
        $post = $this->savepost();

        $dbpost = \App\Post::first();

        $this->assertDatabaseHas('posts', ['title' => $post['title']]);
        $this->assertFalse($dbpost->published);
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

        $response = $this->json('POST', '/posts/savepost', [
            'module_id' => $school->id, 
            'body'      => $post->body,
            'module'    => 'Schools'
        ]);
        
        $this->assertDatabaseMissing('posts', ['title' => $post->title]);
    }

    /** @test */
    public function an_admin_can_mark_a_post_as_a_followup()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $post = create('App\Post');
        $response = $this->json('POST', $post->slug . '/markasfollowup');

        $this->assertTrue($post->fresh()->isFollowUp());
    }

    /** @test */
    public function an_admin_can_unmark_a_post_as_a_followup()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $post = create('App\Post',['followup' => true]);
        $response = $this->json('DELETE', $post->slug . '/unmarkasfollowup');

        $this->assertFalse($post->fresh()->isFollowUp());
    }

    public function savepost() {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);
        $school = create('App\Schools');


        $post = make('App\Post');

        return $response = $this->json('POST', '/posts/savepost', [
            'module_id' => $school->id, 
            'title'     => $post->title, 
            'body'      => $post->body,
            'module'    => 'Schools',
            'meta_description' => $post->meta_description
        ]);
    }
}
