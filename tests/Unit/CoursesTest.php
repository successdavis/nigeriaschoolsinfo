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

    /** @test */
    public function courses_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('courses', [
            'id', "name", "description", "short_name", "logo_path", 'salary', 'slug'
          ]), 1);
    }

	/** @test */
    public function a_course_can_generate_a_string_path()
    {
        $course = create('App\Courses');

        $this->assertEquals("/courses/{$course->slug}", $course->path());
    }
}
