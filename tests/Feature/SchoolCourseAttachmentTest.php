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
            'api/schoolcourseattachment', ['course' => $this->course->id, 'school' => $this->school->id]
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
}
