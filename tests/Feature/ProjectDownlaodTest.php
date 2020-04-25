<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProjectDownlaodTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }

    /** @test */
    public function a_user_can_download_a_project()
    {
        $this->signIn();
        $payment = $this->project->initializePayment('Purchase Project');
        $payment->markSuccessful();

        $this->get(route('project.download',['project' => $this->project->slug]))
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_must_have_a_valid_payment()
    {
        $this->signIn()->withExceptionHandling();

        $this->get(route('project.download',['project' => $this->project->slug]))
            ->assertStatus(402);

    }

    /** @test */
    public function a_user_must_have_atleast_1_download_access_count()
    {
        $this->signIn()->withExceptionHandling();

        $payment = $this->project->initializePayment('Purchase Project');
        $payment->markSuccessful();
        $this->project->recordDownload($payment->id);
        $this->project->recordDownload($payment->id);
        $this->project->recordDownload($payment->id);
        $this->project->recordDownload($payment->id);
        $this->project->recordDownload($payment->id);

        $this->get(route('project.download',['project' => $this->project->slug]))
            ->assertStatus(401);        
    }
}
