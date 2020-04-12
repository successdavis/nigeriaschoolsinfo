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
        $response = $this->json('GET', '/courses')->json();
        $this->assertCount(1, $response['data']);

    }

    /** @test */
    public function a_user_can_view_a_single_course()
    {
        $this->get('/course/' .  $this->course->slug)
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

    /** @test */
    public function a_user_can_sort_course_by_faculties()
    {
        $faculty    = create('App\Faculty');
        $course     = create('App\Courses', ['faculty_id' => $faculty->id]);

        $response = $this->json('GET', '/courses?faculty=' . $faculty->slug)->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_user_can_search_courses_by_name_or_description()
    {
        $course = create('App\Courses', ['name' => 'Computer Sciences and farming']);
        $courseTwo = create('App\Courses', ['description' => 'agriculture and farming']);

        $url = 'courses?s=sciences';

        $courses = $this->json('GET', $url)->json();
        $this->assertCount(1, $courses['data']);

        $url = 'courses?s=farming';

        $courses = $this->json('GET', $url)->json();
        $this->assertCount(2, $courses['data']);
    }

    /** @test */
    public function a_user_can_retreive_all_schools_attached_to_a_course()
    {
        $school = create('App\Schools');
        $manySchools = factory('App\Schools', 20)->create();
        $this->course->attachSchool($school->id, 120);
        $response = $this->json('GET', 
            '/schoolsattached/'. $this->course->slug
        )->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_user_can_retreive_all_school_not_attached_to_a_course()
    {
        $school = create('App\Schools');
        $manySchools = factory('App\Schools', 20)->create();
        $this->course->attachSchool($school->id, 120);

        $response = $this->json('GET', 
            '/schoolsnotattached/'.$this->course->slug
        )->json();
        $this->assertCount(20, $response['data']);
    }
}
