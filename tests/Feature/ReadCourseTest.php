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

    // /** @test */
    // public function a_user_can_view_a_single_course()
    // {
    //     $this->get('/schools/' .  $this->school->slug)
    //         ->assertSee($this->school->name)
    //         ->assertSee($this->school->description);
    // }

    //     /** @test */
    // public function a_user_can_browse_schools_by_school_type()
    // {
    //     $type = create('App\SchoolType');
    //     $schoolInType = create('App\Schools', ['school_type_id' => $type->id]);
    //     $schoolNotInType = create('App\Schools');

    //     $this->get(route('schoolsInType',['schooltype' => $type->slug]))
    //         ->assertSee($schoolInType->name)
    //         ->assertDontSee($schoolNotInType->name);
    // }
}
