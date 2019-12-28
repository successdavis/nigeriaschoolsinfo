<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SponsoredTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
    	parent::setUp();

    	$this->sponsored = create('App\Sponsored');
    }

    /** @test */
    public function sponsored_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('sponsoreds', [
            'id', "name",
          ]), 1);
    }

    /** @test */
    public function a_sponsored_has_many_schools()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->sponsored->schools);
    }
}
