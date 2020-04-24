<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }

    /** @test */
    public function projects_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('projects', [
            'id', "title", "description", 'slug','user_id','course_id','schooltype_id','amount','visits'
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $this->assertEquals("/project/{$this->project->slug}", $this->project->path());
    }

    /** @test */
    public function it_belongs_to_a_type()
    {
        $this->assertInstanceOf('App\SchoolType', $this->project->SchoolType);

    }

    /** @test */
    public function it_belongs_to_a_course()
    {
        $this->assertInstanceOf('App\Courses', $this->project->course);

    }

    /** @test */
    public function it_determine_if_a_user_has_paid_for_it()
    {
        $this->signIn();
        $payment = $this->project->initializePayment('Project Purchase');
        $payment->markSuccessful();

        $this->assertTrue($this->project->isBilled());
    }
}
