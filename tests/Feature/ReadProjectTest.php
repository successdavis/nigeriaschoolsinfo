<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }

    /** @test */
    public function a_user_can_read_all_projects()
    {
        $responds = $this->get('/projects')
            ->assertSee($this->project->title)
            ->assertSee($this->project->description);
    }

    /** @test */
    public function a_user_can_view_a_single_project()
    {

        $responds = $this->get($this->project->path())
            ->assertSee($this->project->title)
            ->assertSee($this->project->description);
    }
}
