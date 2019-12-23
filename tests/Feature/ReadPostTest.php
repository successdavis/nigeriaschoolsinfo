<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadPostTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Read Post Test
     *
     * @return void
     */
        /** @test */
    public function a_user_can_read_all_recent_published_post()
    {
        $post = create('App\Post');

        $this->get('/')
            ->assertSee($post->title)
            ->assertSee($post->body);
    }
}
