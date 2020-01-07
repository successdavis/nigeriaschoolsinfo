<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CourseSubjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Courses');
        $this->subject = create('App\Subject');
    }

    /** @test */
    public function an_admin_can_attach_a_subject_to_a_course()
    {
        $subject = create('App\Subject');
        $this->json('POST', '/api/' . $this->course->slug .'/attachSubject', ['subject' => $this->subject->id]);

        $this->assertCount(1, $this->course->subjects);
    }

    /** @test */
    public function a_user_can_retrieve_subjects_attached_to_a_course()
    {
        $subjects = factory('App\Subject', 3)->create();
        $this->course->attachSubjects($subjects);
        
        $responds = $this->json('get', '/api/' . $this->course->slug .'/getsubjects')->json();

        $this->assertCount(3, $responds);
    }
}
