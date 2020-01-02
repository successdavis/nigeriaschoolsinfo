<?php

namespace Tests\Unit;

use App\Lga;
use App\Sponsored;
use App\States;
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
            'id', "name", "description", "date_created", "logo_path", "website", "portal_website","states_id","lga_id","address", "admitting", "school_type_id", "phone", "email", 'sponsored_id', 'jamb_points',
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

    /** @test */
    public function a_school_belongs_to_a_state()
    {
        $this->assertInstanceOf(States::class, $this->school->state);
    }

    /** @test */
    public function a_school_belongs_to_a_lga()
    {
        $this->assertInstanceOf(Lga::class, $this->school->lga);
    }

    /** @test */
    public function a_school_admission_can_be_open()
    {
        $this->school->openAdmission();

        $this->assertTrue($this->school->isAdmitting());
    }
}
