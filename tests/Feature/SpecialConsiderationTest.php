<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SpecialConsiderationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Courses');
        $this->consideration = create('App\Consideration');
    }

    /** @test */
    public function a_consideration_belongs_to_a_user()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->course->considerations);
    }

    /** @test */
    public function an_admin_can_create_a_special_consideration_for_a_course()
    {
        $consideration = make('App\Consideration')->toArray();

        $response = $this->json('POST', 'api/' . $this->course->slug . '/addconsideration', $consideration);

        $this->assertCount(1, $this->course->considerations);
    }

    /** @test */
    public function a_user_can_retrieve_all_consideration_for_a_lecture()
    {
        $considerations = create('App\Consideration', ['course_id' => $this->course->id]);

        $response = $this->json('GET', 'api/' . $this->course->slug . '/getconsiderations' )->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function an_admin_can_delete_a_consideration_link_to_a_course()
    {
        $considerations = create('App\Consideration', ['course_id' => $this->course->id]);

        $response = $this->json('DELETE', 'api/' . $considerations->id . '/delete' )->json();

        $this->assertCount(0, $this->course->considerations);
    }
}
