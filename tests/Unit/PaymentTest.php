<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        
    }

    /** @test */
    public function it_has_the_required_fields_in_the_data_base()
    {
    	$this->assertTrue(Schema::hasColumns('payments', [
	    	'id', "amount", "method", "description", "transaction_ref", 'billable_id', 'billable_type'
	  	]), 1);
    }

    /** @test */
    public function a_payment_can_be_initialized()
    {
    	$project = create('App\Project');
        $data = $project->toArray();
        $data['module'] = 'Project';
        $data['description'] = 'Project Purchase';

        $responds = $this->json('POST', route('payment.create'), $data)->json();

    	$this->assertDatabaseHas('payments', ['billable_id' => $project->id]);
    }
}
