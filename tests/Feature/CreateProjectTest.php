<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function an_admin_can_create_a_project()
    {
        $this->signIn();

        $project = make('App\Project');

        $responds = $this->json('POST', 'projects/newproject', $project->toArray())->json();

        $this->assertDatabaseHas('projects', [
            'title' => $project->title
        ]);
    }

    /** @test */
    public function it_requires_a_title()
    {
        $this->signIn();

        $project = make('App\Project',['title' => '']);

        $this->expectException('Illuminate\Validation\ValidationException');
        $responds = $this->json('POST', 'projects/newproject', $project->toArray())->json();
    }
}
