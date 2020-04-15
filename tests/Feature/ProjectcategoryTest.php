<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProjectcategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = create('App\Projectcategory');
    }

    /** @test */
    public function projects_category_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('projectcategories', [
            'id', "title", "description", 'slug'
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $this->assertEquals("/projects-category/{$this->category->slug}", $this->category->path());
    }
}
