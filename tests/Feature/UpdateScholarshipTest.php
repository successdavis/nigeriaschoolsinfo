<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdateScholarshipTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->scholarship = create('App\Scholarship');
    }


    /** @test */
    public function a_scholarship_can_be_updated()
    {
        $user = create('App\User');
        $this->scholarship = $scholarship = create('App\Scholarship',['user_id' => $user->id]);

        $this->signIn($user);
        $data = $this->scholarship->toArray();
        $data['title'] = 'Changed Title';

        $this->json('PATCH', route('scholarship.update',['scholarship' => $this->scholarship->slug]), $data)->json();

        $this->assertEquals('Changed Title', $this->scholarship->fresh()->title);
    }

    /** @test */
    public function it_can_be_updated_only_by_its_creator()
    {
        $this->signIn()->withExceptionHandling();

        $this->patch(route('scholarship.update',['scholarship' => $this->scholarship->slug]), $this->scholarship->toArray())
            ->assertStatus(403);
    }
}
