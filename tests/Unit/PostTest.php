<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */

    public function a_post_can_be_morphed_to_a_school_model()
    {
    	$post = factory('App\Post')->create();

    	$this->assertInstanceOf('App\Schools', $post->source);
    }

    /** @test */
    public function it_can_be_morphed_to_an_exam_model()
    {
    	$post = factory('App\Post')->states('exams')->create();

    	$this->assertInstanceOf('App\Exams', $post->source);
    }

	/** @test */
    public function it_generate_a_string_path()
    {
        $post = create('App\Post');

        $this->assertEquals("/posts/{$post->title}", $post->path());
    }
}
