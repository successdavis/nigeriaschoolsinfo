<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadPostcategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = create('App\Postcategory');
    }

    /** @test */
    public function a_user_can_view_all_post_in_a_category()
    {
        $post = factory('App\Post')->create([
            'source_id'     => $this->category->id,
            'source_type'   => 'App\Postcategory'
        ]);

        $this->get('/post-category/' . $this->category->slug)
            ->assertSee($post->title);
    }
}
