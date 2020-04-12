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

        $this->get('/latest-nigeria-education-news')
            ->assertSee($post->title);
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

    /** @test */
    public function a_user_can_search_through_posts()
    {
        $this->signIn(create('App\User'));
        $inSearchQuery = create('App\Post', ['title' => 'user searched term']);
        $posts = create('App\Post', [], 10);

        $response = $this->json('GET', '/latest-nigeria-education-news', [
            'q'    => 'searched',
        ])->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function it_record_a_new_visit_each_time_the_post_is_read()
    {
        $this->signIn(create('App\User'));

        $post = create('App\Post');

        $this->assertSame(0, $post->visits);

        $this->call('GET', $post->path());

        $this->assertEquals(1, $post->fresh()->visits);
    }
}
