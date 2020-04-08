<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
        $this->comment = create('App\Comment');
    }

	/** @test */
    public function comments_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('comments', [
            'id', "body", "commentable_id", "commentable_type", "user_id", "parent_id"
          ]), 1);
    }


    /** @test */
    public function a_comment_is_associated_to_a_user()
    {
        $this->assertInstanceOf('App\User', $this->comment->owner);
    }

    /** @test */
    public function it_belongs_to_a_post()
    {
        $this->assertInstanceOf('App\Post', $this->comment->commentable);

    }

        /** @test */
    public function it_knows_if_it_was_just_publish()
    {
        $comment = create('App\Comment');

        $this->assertTrue($comment->wasJustPublished());

        $comment->created_at = Carbon::now()->subMonth();

        $this->assertFalse($comment->wasJustPublished());
    }

    // /** @test */
    // public function it_knows_if_it_is_the_best_comment()
    // {
    //     $comment = create('App\Comment');
    //     $this->assertFalse($comment->isBest());

    //     $comment->commentable->update(['best_comment_id' => $comment->id]);
    //     $this->assertTrue($comment->fresh()->isBest());
    // }
}
