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
        $post = create('App\Post', [], 10);

        $response = $this->json('GET', '/posts/relatedpost', [
            'module'    => 'Schools',
            'module_id' => '1',
        ])->json();

        $this->assertCount(10, $response);
    }
}
