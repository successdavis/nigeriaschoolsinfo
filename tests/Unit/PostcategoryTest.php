<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class PostcategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }


    /** @test */
    public function postcategories_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('postcategories', [
            'id', "title", "description", "meta_description", "slug", "visits"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $category = create('App\Postcategory');

        $this->assertEquals("/post-category/{$category->slug}", $category->path());
    }

}
