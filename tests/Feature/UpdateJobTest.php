<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdateJobTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->job = create('App\Job');
    }

    /** @test */
    public function a_user_can_update_a_job()
    {
        $this->signIn();
        $data = $this->job->toArray();
        $data['title'] = 'Changed Title';

        $this->json('PATCH', route('jobs.update',['job' => $this->job->slug]), $data)->json();

        $this->assertEquals('Changed Title', $this->job->fresh()->title);
    }
}
