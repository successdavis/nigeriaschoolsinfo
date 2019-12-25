<?php

namespace Tests\Unit;

use App\Advertisements;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class AdvertisementTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
    	parent::setUp();

    	$this->advertisement = create('App\Advertisements');
    }

        /** @test */
    public function advertisements_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('advertisements', [
            'id', "name", "image_path", "primary_link", "secondary_link", "sypnosis", "active", 'deactivated_at', 'activated_at'
          ]), 1);
    }

    /** @test */
    public function an_advertisement_can_be_deactivated()
    {
    	$advertisement = factory('App\Advertisements')->states('active')->create();
    	$advertisement->deactive();

    	$this->assertFalse($this->advertisement->status());
    	
    }

    /** @test */
    public function an_advertisement_can_be_activated()
    {
    	$this->advertisement->activate();

    	$this->assertTrue($this->advertisement->status());
    	
    }

    /** @test */
    public function all_active_advertisements_can_be_retrieved()
    {
        $advertisementOne = factory('App\Advertisements', 3)->states('active')->create();

        $activeAdverts = Advertisements::activeAdverts()->toArray();

        $this->assertNotContains($this->advertisement->name, $activeAdverts);
    }

    /** @test */
    public function all_in_active_advertisements_can_be_retrieved()
    {
        $advertisementAll = factory('App\Advertisements', 3)->states('active')->create();

        $inActiveAdverts = Advertisements::inActiveAdverts()->toArray();

        $this->assertCount(1, $inActiveAdverts);
    }


}
