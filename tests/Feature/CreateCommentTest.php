<?php

namespace Tests\Feature;

use App\comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CreateCommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = create('App\Post');
    }

    /** @test */
    public function a_user_can_comment_on_a_post()
    {
        $this->signIn();

        $comment = make('App\Comment');

        $responds = $this->json('POST', route('comment.store', ['post' => $this->post->slug]), $comment->toArray());

        $this->assertCount(1, comment::all());
    }

    /** @test */
    public function a_user_must_be_signed_in_to_add_a_comment()
    {
        $this->withExceptionHandling();
        $comment = make('App\Comment');

        $responds = $this->post(route('comment.create', ['post' => $this->post->slug]), $comment->toArray())
            ->assertStatus(302);
    }
}
