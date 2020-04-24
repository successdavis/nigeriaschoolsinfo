<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreatePaymentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function a_paymentis_initialized_when_a_user_request_to_make_a_payment()
    {
        $this->signIn();
        
        $project = create('App\Project');

        $data = ['description' => 'Project Purchase', 'module' => 'Project', 'id' => $project->id];

        $responds = $this->json('POST', route('payment.create'), $data)->json();

        $this->assertDatabaseHas('payments', ['billable_id' => $project->id]);
    }
}
