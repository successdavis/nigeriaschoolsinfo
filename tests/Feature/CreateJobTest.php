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

        $this->json('POST','jobs/create',$data)->json();

        $this->assertDatabaseHas('jobs', ['title' => $data['title']]);
    }
}
