<?php

namespace Tests\Unit;

use App\Sponsored;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp(): void
    {
        parent::setUp();

        $this->school = create('App\Schools');
        $this->course = create('App\Courses');
    }

    /** @test */
    public function schools_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('schools', [
            'id', "name", "description", "date_created", "logo_path", "website", "portal_website","state","lga","address", "admitting", "school_type_id", "phone", "email", 'sponsored', 'jamb_points', 'cut_of_points'
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $school = create('App\Schools');

        $this->assertEquals("/schools/{$school->slug}", $school->path());
    }

    /** @test */
    public function it_belongs_to_a_type()
    {
        $school = create('App\Schools');

        $this->assertInstanceOf('App\SchoolType', $school->SchoolType);

    }

    /** @test */
    public function a_school_belongs_to_many_courses()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->course->schools);
    }

    /** @test */
    public function a_school_belongs_to_a_sponsor()
    {
        $this->assertInstanceOf(Sponsored::class, $this->school->sponsored);
    }
}
