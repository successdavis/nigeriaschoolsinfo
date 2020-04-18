<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdateProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }

    /** @test */
    public function a_project_can_be_updated()
    {
        $this->signIn();
        $project = $this->project->toArray();
        $project['title'] = 'Changed title';
        $project['description'] = 'Changed description';
        unset($project['id']);

        $this->json('PATCH', route('project.update',['project' => $project['slug']]), $project);

        $this->assertEquals('Changed title', $this->project->fresh()->title);
    }
}
