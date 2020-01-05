<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class EditCourseTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Courses');
    }

    /** @test */
    public function an_admin_can_edit_a_course()
    {
        $response = $this->json('POST', route('course.edit', ['course' => $this->course->slug]), ['description' => 'some new description']);

        $this->assertEquals($this->course->fresh()->description, 'some new description');
    }
}
