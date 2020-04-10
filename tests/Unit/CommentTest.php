<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
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

    /** @test */
    public function it_can_be_deleted()
    {
        $user = create('App\User');
        $this->signIn($user);
        $comment = create('App\Comment', ['user_id' => $user->id]);

        $this->json('DELETE', route('comment.destroy', ['comment' => $comment->id]));

        $this->assertDatabaseMissing('comments', [
            'body' => $comment->body,
        ]);
        
    }

    /** @test */
    public function all_children_comments_gets_deleted_when_a_parent_comment_is_deleted()
    {
        $user = create('App\User');
        $this->signIn($user);
        $comment = create('App\Comment', ['user_id' => $user->id]);

        $childcomment = create('App\Comment', ['parent_id' => $comment->id]);
        $childcomment2 = create('App\Comment', ['parent_id' => $childcomment->id]);
        // $secondchild = create('App\')

        $this->json('DELETE', route('comment.destroy', ['comment' => $comment->id]));

        $this->assertDatabaseMissing('comments', [
            'body' => $childcomment->body,
            'body' => $childcomment2->body,
        ]);
        
    }

    /** @test */
    public function it_cannot_be_deleted_by_a_guest_or_any_user_except_its_owner()
    {
        $this->signIn()->withExceptionHandling();

        $this->json('DESTROY', route('comment.destroy', ['comment' => $this->comment->id]));

        $this->assertDatabaseHas('comments', [
            'body' => $this->comment->body,
        ]);
    }

    /** @test */
    public function it_can_be_edited_by_its_creator()
    {
        $this->signIn($user = create('App\User'));
        $comment = create('App\Comment', ['user_id' => $user->id]);

        $body = 'Some new body';

        $this->json(
            'PATCH', 
            route('comment.update', ['comment' => $comment->id]), 
            ['body' => $body]
        );

        $this->assertEquals($body, $comment->fresh()->body);
    }

    /** @test */
    public function unauthorized_user_cannot_update_a_comment()
    {
        $this->signIn();

        $this->expectException(AuthorizationException::class);
        $this->json(
            'PATCH', 
            route('comment.update', ['comment' => $this->comment->id]));


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
