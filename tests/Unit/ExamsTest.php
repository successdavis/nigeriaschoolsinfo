<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ExamsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->exam = create('App\Exams');
    }

      /** @test */
    public function exams_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('exams', [
            'id', "name", "description", "date_created", "logo_path", "website", "portal_website", "admitting", "phone", "email"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $exams = create('App\Exams');

        $this->assertEquals("/exams/{$exams->slug}", $exams->path());
    }

    /** @test */
    public function an_exam_registration_can_be_open()
    {
        $this->exam->openRegistration();
        $this->assertEquals('Open', $this->exam->registrationStatus());
    }

    /** @test */
    public function an_exams_registration_can_be_closed()
    {
        $this->exam->openRegistration();
        $this->exam->closeRegistration();
        $this->assertEquals('Closed', $this->exam->registrationStatus());
    }

    /** @test */
    public function a_exam_ends_date_can_be_retrieved()
    {
        $this->assertEquals('Undefined', $this->exam->registrationEndsAt());
        
        $date = Carbon::now()->addWeeks(2);
        $this->exam->openRegistration($date);

        $this->exam->registrationEndsAt();

        $this->assertEquals($date->diffForHumans(), $this->exam->registrationEndsAt());
    }
}
