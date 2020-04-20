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
    public function a_job_can_be_updated()
    {
        $user = create('App\User');
        $this->job = $job = create('App\Job',['user_id' => $user->id]);

        $this->signIn($user);
        $data = $this->job->toArray();
        $data['title'] = 'Changed Title';

        $this->json('PATCH', route('jobs.update',['job' => $this->job->slug]), $data)->json();

        $this->assertEquals('Changed Title', $this->job->fresh()->title);
    }

    /** @test */
    public function it_can_be_updated_only_by_its_creator()
    {
        $this->signIn()->withExceptionHandling();

        $this->patch(route('jobs.update',['job' => $this->job->slug]), $this->job->toArray())
            ->assertStatus(403);
    }

}
