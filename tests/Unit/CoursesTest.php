<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class CoursesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->course = Create('App\Courses');
        $this->school = Create('App\Schools');
    }

    /** @test */
    public function courses_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('courses', [
            'id', "name", "description", "short_name", "logo_path", 'salary', 'slug','duration'
          ]), 1);
    }

	/** @test */
    public function a_course_can_generate_a_string_path()
    {
        $course = create('App\Courses');

        $this->assertEquals("/course/{$course->slug}", $course->path());
    }

    /** @test */
    public function a_course_belongs_to_many_schools()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->school->courses);
    }

    /** @test */
    public function a_course_can_be_attached_to_a_school()
    {
        $this->school->addCourse($this->course);

        $this->assertCount(1, $this->school->courses);
    }

    /** @test */
    public function a_course_can_be_attached_to_a_faculty()
    {
        $this->assertInstanceOf('App\Faculty', $this->course->faculty);
    }

    /** @test */
    public function a_course_can_have_many_subjects()
    {
        $subject = create('App\Subject');

        $this->course->attachSubject($subject);

        $this->assertCount(1, $this->course->subjects);

    }

    /** @test */
    public function a_course_can_be_detached_from_a_school()
    {
        $school = create('App\Schools');

        $this->course->attachSchool($school->id);
        $this->assertCount(1, $this->course->schools);

        $this->course->detachSchool($school->id);
        $this->assertCount(0, $this->course->fresh()->schools);

    }
}
