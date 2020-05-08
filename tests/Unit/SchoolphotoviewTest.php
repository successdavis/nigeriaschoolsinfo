<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SchoolphotoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->schoolphoto = create('App\Schoolphoto');
    }

        /** @test */
    public function Schoolphotos_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('Schoolphotos', [
            'id', "caption", "description", "schools_id","url"
          ]), 1);
    }

    /** @test */
    public function it_belongs_to_a_school()
    {
        $this->assertInstanceOf('App\Schools', $this->schoolphoto->school);
    }
}
