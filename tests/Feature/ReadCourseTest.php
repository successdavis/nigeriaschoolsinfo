<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadCourseTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->course = Create('App\Courses');
    }

       /** @test */
    public function a_user_can_browse_all_courses()
    {
        $this->get('/courses')
            ->assertSee($this->course->name);

    }

    /** @test */
    public function a_user_can_view_a_single_course()
    {
        $this->get('/courses/' .  $this->course->slug)
            ->assertSee($this->course->name)
            ->assertSee($this->course->description);
    }

        /** @test */
    public function a_user_can_browse_courses_by_school()
    {
        $school = create('App\Schools');
        $courseInSchool = create('App\Courses');
        $courseNotInSchool = create('App\Courses');

        $school->addCourse($courseInSchool);

        $this->assertCount(1, $school->courses);
    }
}
