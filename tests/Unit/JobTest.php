<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use Tests\TestCase;


class JobTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->job = create('App\Job',['ends_at' => null]);
    }

      /** @test */
    public function jobs_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('jobs', [
            'id', "title", "description", "portal_website", "ends_at", "phone", "location","employer","meta_description","slug"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $jobs = create('App\Job');

        $this->assertEquals("/jobs/{$jobs->slug}", $jobs->path());
    }

    /** @test */
    public function a_job_recruitment_can_be_open()
    {
        $this->job->openRecruitment();
        $this->assertEquals('Open', $this->job->fresh()->recruitmentStatus());
    }

    /** @test */
    public function a_job_recruitment_can_be_closed()
    {
        $this->job->openRecruitment();
        $this->job->closeRegistration();
        $this->assertEquals('Closed', $this->job->recruitmentStatus());
    }

    /** @test */
    public function a_job_ends_date_can_be_retrieved()
    {
        $this->assertEquals('Undefined', $this->job->recuritmentEndsAt());
        
        $date = Carbon::now()->addWeeks(2);
        $this->job->openRecruitment($date);

        $this->job->recuritmentEndsAt();

        $this->assertEquals($date->diffForHumans(), $this->job->recuritmentEndsAt());
    }
        /** @test */
    public function it_knows_if_it_was_just_publish()
    {
        $job = create('App\Job');

        $this->assertTrue($job->wasJustPublished());

        $job->created_at = Carbon::now()->subMonth();

        $this->assertFalse($job->wasJustPublished());
    }
}
