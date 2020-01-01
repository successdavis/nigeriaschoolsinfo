<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;


class FacultyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
    	parent::setUp();

    	$this->faculty = create('App\Faculty');
    }

    /** @test */
    public function courses_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('courses', [
            'id', "name", "slug"
          ]), 1);
    }

	/** @test */
    public function a_faculty_can_generate_a_string_path()
    {
        $this->assertEquals("/faculty/{$this->faculty->slug}", $this->faculty->path());
    }

}
