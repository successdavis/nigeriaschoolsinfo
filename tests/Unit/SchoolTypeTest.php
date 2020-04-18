<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SchoolTypeTest extends TestCase
{
    use DatabaseMigrations;

	// This class SchoolType is also referred to as Education Levels


    /** @test */
    public function school_type_generate_a_string_path()
    {
        $type = create('App\SchoolType');

        $this->assertEquals("/schools/type/{$type->slug}", $type->path());
    }

    /** @test */
    public function all_school_types_can_be_retrieved_and_referenced_as_education_levels()
    {
    	$Levels = create('App\SchoolType',[],5);
    	$responds = $this->json('GET', '/educationlevels')->json();
    	$this->assertCount(5, $responds);
    }
}
