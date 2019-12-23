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
}
