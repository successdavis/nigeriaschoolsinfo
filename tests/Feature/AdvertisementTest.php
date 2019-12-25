<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdvertisementTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
    	parent::setUp();

    	$this->advertsiement = create('App\Advertisements');
    }



}
