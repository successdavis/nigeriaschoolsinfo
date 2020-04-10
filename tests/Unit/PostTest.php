<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = create('App\Post');
        
    }

    public function a_post_can_be_morphed_to_a_school_model()
    {
    	$this->assertInstanceOf('App\Schools', $this->post->source);
    }

    /** @test */
    public function it_can_be_morphed_to_an_exam_model()
    {
    	$post = factory('App\Post')->states('exams')->create();

    	$this->assertInstanceOf('App\Exams', $post->source);
    }

    /** @test */
    public function it_is_an_instance_of_user()
    {
        $this->assertInstanceOf('App\User', $this->post->publisher);
    }

	/** @test */
    public function it_generate_a_string_path()
    {
        $this->assertEquals("/posts/{$this->post->slug}", $this->post->path());
    }

    /** @test */
    public function a_post_may_be_lock_and_unlocked()
    {
        $this->assertFalse($this->post->locked);

        $this->post->lock();

        $this->assertTrue($this->post->locked);
    }
}
