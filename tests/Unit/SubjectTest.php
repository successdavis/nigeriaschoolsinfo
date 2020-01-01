<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class SubjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->subject = create('App\Subject');
    }

        /** @test */
    public function subjects_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('schools', [
            'id', "name"
          ]), 1);
    }
}
