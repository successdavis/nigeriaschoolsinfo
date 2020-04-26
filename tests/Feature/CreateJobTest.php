<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


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

        /** @test */
    public function a_featured_image_can_be_uploaded_to_a_job()
    {        
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $job = create('App\Job',['user_id' => $user->id]);

        Storage::fake('public');

        $responds = $this->json('POST', 
            route('jobs.featured_image',['job' => $job->slug]), 
            ['file' => $file = UploadedFile::fake()->image('logo.jpg')]
        );

        Storage::disk('public')->assertExists($job->fresh()->featured_image);
    }
}
