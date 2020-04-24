<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateJobTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->job = create('App\Job');
    }

    /** @test */
    public function a_user_can_create_a_new_job()
    {
        $this->signIn();
        
        $data = $this->job->toArray();
        unset($data['id']);

        $this->json('POST','/jobs/create',$data)->json();

        $this->assertDatabaseHas('jobs', ['title' => $data['title']]);
    }

    /** @test */
    public function you_must_wait_for_atleast_5min_to_create_a_new_job()
    {
        $this->withExceptionHandling();
        $user = create('App\User');
        $this->signIn($user);

        $job = create('App\Job',['user_id' => $user->id]);
        
        $data = $this->job->toArray();
        unset($data['id']);

        $this->post('jobs/create',$data)
            ->assertStatus(403);
    }
}
