<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadSChoolTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->school = create('App\Schools');
    }

    /** @test */
    public function a_user_can_browse_all_schools()
    {
        $this->get('/schools')
            ->assertSee($this->school->name);
    }

    /** @test */
    public function a_user_can_view_a_single_school()
    {
        $this->get('/schools/' .  $this->school->slug)
            ->assertSee($this->school->name)
            ->assertSee($this->school->description);
    }

    //     /** @test */
    // public function a_user_can_browse_schools_by_type()
    // {
    //     $channel = create('App\Schools', ['type' => 'University']);
    //     $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
    //     $threadNotInChannel = create('App\Thread');

    //     $this->get('/threads/'. $channel->slug)
    //         ->assertSee($threadInChannel->title)
    //         ->assertDontSee($threadNotInChannel);
    // }
}