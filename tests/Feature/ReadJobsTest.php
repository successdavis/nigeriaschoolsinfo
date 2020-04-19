<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadJobsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->job = create('App\Job');
    }

    /** @test */
    public function a_user_can_browse_all_jobs()
    {
        $response = $this->json('GET', '/jobs-opportunities-in-nigeria')->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_user_can_view_a_single_job()
    {
        $this->get('/jobs/' .  $this->job->slug)
            ->assertSee($this->job->name)
            ->assertSee($this->job->description);
    }

    /** @test */
    public function a_user_can_filter_jobs_by_status()
    {
        $this->job->openRecruitment();
        $jobTwo = create('App\Job');

        $response = $this->json('GET', '/jobs-opportunities-in-nigeria?status=open');
        $this->assertCount(1, $response['data']);
    }

        /** @test */
    public function a_user_can_search_jobs_by_name_or_description()
    {
        $job = create('App\Job', ['title' => 'Stechmax Offering Admission']);
        $jobTwo = create('App\Job', ['description' => 'some really long description here']);

        $url = 'jobs-opportunities-in-nigeria?s=Stechmax';

        $jobs = $this->json('GET', $url)->json();
        $this->assertCount(1, $jobs['data']);

        $url = 'jobs-opportunities-in-nigeria?s=description';

        $jobs = $this->json('GET', $url)->json();
        $this->assertCount(1, $jobs['data']);
    }
}
