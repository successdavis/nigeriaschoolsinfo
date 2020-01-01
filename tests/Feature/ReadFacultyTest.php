<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadFacultyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->faculty = create('App\Faculty');
    }

    /** @test */
    public function a_user_can_browse_all_courses_associated_with_a_faculty()
    {
        $course = create('App\Courses',['faculty_id' => $this->faculty->id]);
        $courseTwo = create('App\Courses');

        $this->get(route('faculty.show', ['faculty' => $this->faculty->slug]))
            ->assertSee($course->name)
            ->assertDontSee($courseTwo->name);
    }
}
