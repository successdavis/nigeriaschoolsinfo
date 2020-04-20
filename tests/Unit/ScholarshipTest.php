<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ScholarshipTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
     	$this->scholarship = create('App\Scholarship',['ends_at' => null]);   
    }


      /** @test */
    public function scholarship_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('scholarships', [
            'id', "title", "description", "portal_website", "ends_at", "location","institution","meta_description","slug","user_id"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $scholarship = create('App\Scholarship');

        $this->assertEquals("/scholarship/{$scholarship->slug}", $scholarship->path());
    }

    /** @test */
    public function a_scholarship_application_can_be_open()
    {
        $this->scholarship->openApplication();
        $this->assertEquals('Open', $this->scholarship->fresh()->applicationStatus());
    }

    /** @test */
    public function a_scholarship_application_can_be_closed()
    {
        $this->scholarship->openApplication();
        $this->scholarship->closeApplication();
        $this->assertEquals('Closed', $this->scholarship->applicationStatus());
    }

    /** @test */
    public function a_scholarship_ends_date_can_be_retrieved()
    {
        $this->assertEquals('Undefined', $this->scholarship->applicationEndsAt());
        
        $date = Carbon::now()->addWeeks(2);
        $this->scholarship->openApplication($date);

        $this->scholarship->applicationEndsAt();

        $this->assertEquals($date->diffForHumans(), $this->scholarship->applicationEndsAt());
    }
}
