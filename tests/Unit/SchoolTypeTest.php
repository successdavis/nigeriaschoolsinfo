<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SchoolTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function school_type_generate_a_string_path()
    {
        $type = create('App\SchoolType');

        $this->assertEquals("/schooltypes/{$type->slug}", $type->path());
    }
}
