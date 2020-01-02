<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class StatesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->state = create('App\States');
    }

    /** @test */
    public function a_state_has_many_lga()
    {
    	$lga = create('App\Lga', ['states_id' => $this->state->id]);

    	$this->assertCount(1, $this->state->lgas);
    }

    /** @test */
    public function a_state_has_many_schools()
    {
        $school = create('App\Schools', ['states_id' => $this->state->id]);

        $this->assertCount(1, $this->state->schools);
    }
}
