<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadCommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->comment = create('App\Comment');
    }

    /** @test */
    public function a_user_can_read_all_comments_in_a_post()
    {
        create('App\Comment',[],10);
    	$post = create('App\Post');
    	$comments = create('App\Comment',['commentable_id' => $post->id], 20);

    	$responds = $this->json('GET','/comments?commentable_type=Post&&commentable_id=' . $post->id)->json();

    	$this->assertCount(20, $responds['root']);
    }

    /** @test */
    public function a_user_can_read_all_comments_in_a_job()
    {
        create('App\Comment',[],10);
        $job = create('App\Job');
        $comments = factory('App\Comment',20)->states('job')->create(['commentable_id' => $job->id]);

        $responds = $this->json('GET','/comments?commentable_type=Job&&commentable_id=' . $job->id)->json();

        $this->assertCount(20, $responds['root']);
    }
}
