<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LGATest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->lga = create('App\Lga');
    }

    /** @test */
    public function it_belongs_to_a_state()
    {   
    	$this->assertInstanceOf('App\States', $this->lga->state);
    }

    /** @test */
    public function it_has_many_schools()
    {
        $school = create('App\Schools', ['lga_id' => $this->lga->id]);

        $this->assertCount(1, $this->lga->schools);
    }
}
