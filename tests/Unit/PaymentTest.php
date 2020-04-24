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
    public function it_can_be_initialized_with_payment_status_equal_0()
    {
        $this->signIn();

        $project = create('App\Project');
        
        $project->initializePayment('Project Payment');

        $this->assertDatabaseHas('payments', ['billable_id' => $project->id]);
    }

    /** @test */
    public function it_can_be_marked_as_a_successful_payment()
    {
        $this->signIn();
        $project = create('App\Project');
        $payment = $project->initializePayment('Project Payment');

        $this->assertFalse($payment->status());
        $payment->markSuccessful();

        $this->assertTrue($payment->fresh()->status());
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $payment = create('App\Payment');

        $this->assertInstanceOf('App\User', $payment->user);
    }


    /** @test */
    public function it_has_a_method_to_return_payment_by_a_user_for_a_module()
    {
        $this->signIn();
        $project = create('App\Project');
        $payment = $project->initializePayment('Project Purchase');
        $payment->markSuccessful();
        $payment = $project->getUserPayment();
        $this->assertEquals(1, $payment->id);
    }
}
