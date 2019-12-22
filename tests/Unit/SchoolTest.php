<?php

namespace Tests\Unit;

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
    }

    /** @test */
    public function schools_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('schools', [
            'id', "name", "description", "date_created", "logo_path", "website", "portal-website","state","lga","address", "admitting", "type", "phone", "email"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $school = create('App\Schools');

        $this->assertEquals("/schools/{$school->slug}", $school->path());
    }
}
