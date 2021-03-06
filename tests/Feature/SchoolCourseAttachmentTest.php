<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SchoolCourseAttachmentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Courses');
        $this->school = create('App\Schools');
    }

    /** @test */
    public function an_admin_can_attach_a_course_to_a_school_or_vice_versa()
    {
        $response = $this->json('POST', 
            'api/schoolcourseattachment', ['course' => $this->course->id, 'school' => $this->school->id, 'cut_off_points' => 150]
        )->json();

        $this->assertCount(1, $this->course->schools);
    }

    /** @test */
    public function an_admin_can_detach_a_school_from_a_course_or_vice_versa()
    {
        $response = $this->json('DELETE', 
            'api/schoolcoursedetachment', ['course' => $this->course->id, 'school' => $this->school->id]
        )->json();

        $this->assertCount(0, $this->course->schools);
    }

    /** @test */
    public function an_admin_can_attach_many_school_at_a_time()
    {
        $schools = factory('App\Schools', 5)->create();
        $schoolIds = ['1', '2', '3'];

        $response = $this->json('POST', 
            'api/schoolcourseattachmany/' . $this->course->slug, ['schools' => $schoolIds]
        )->json();

        $this->assertCount(3, $this->course->schools);
    }
}
