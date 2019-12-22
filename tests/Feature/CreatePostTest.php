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
    public function a_post_requires_a_unique_slug()
    {
        $this->signIn();

        $post = create('App\Post', ['title' => 'Foo Title']);

        $this->assertEquals($post->fresh()->slug, 'foo-title');

        // $post = $this->postJson(route('posts.save'), $post->toArray())->json();

        // $this->assertEquals("foo-title-{$post['id']}", $post['slug']);
    }
}
