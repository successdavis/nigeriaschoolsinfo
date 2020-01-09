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

        $this->json('UPDATE', '/posts/updatepost/' . $this->post->slug, [
            'title'     => 'hello world', 
            'body'      => 'The quick brown fox'
        ])->json();

        $this->assertEquals($this->post->fresh()->title, 'hello world');
    }
}
