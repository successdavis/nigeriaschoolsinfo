<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateScholarshipTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->scholarship = create('App\Scholarship');
    }

      /** @test */
    public function a_user_can_create_a_new_scholarship()
    {
        $this->signIn();
        
        $data = $this->scholarship->toArray();
        unset($data['id']);

        $this->json('POST','scholarships/create',$data)->json();

        $this->assertDatabaseHas('scholarships', ['title' => $data['title']]);
    }

    /** @test */
    public function you_must_wait_for_atleast_5min_to_create_a_new_scholarship()
    {
        $this->withExceptionHandling();
        $user = create('App\User');
        $this->signIn($user);

        $scholarship = create('App\Scholarship',['user_id' => $user->id]);
        
        $data = $this->scholarship->toArray();
        unset($data['id']);

        $this->post('scholarships/create',$data)
            ->assertStatus(403);
    }
}
