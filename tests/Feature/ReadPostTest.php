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
            ->assertSee(e($post->title));
    }

    /** @test */
    public function a_user_can_retrieve_related_post_to_a_module()
    {
        $this->signIn(create('App\User'));

        $school = create('App\Schools');
        $post = factory('App\Post', 10)->create(['source_id' => $school->id]);
        $posts = create('App\Post', [], 10);

        $response = $this->json('GET', '/posts/relatedpost', [
            'module'    => 'Schools',
            'module_id' => '1',
        ])->json();

        $this->assertCount(10, $response['data']);
    }

    // /** @test */
    // public function a_user_can_request_all_comments_for_a_given_post()
    // {
    //     $post = create('App\Post');
    //     create('App\Comment', ['commentable_id' => $post->id], 2);

    //     $response = $this->getJson($post->path() . '/comments')->json();

    //     $this->assertCount(2, $response['data']);
    //     $this->assertEquals(2, $response['total']);
    // }
}
