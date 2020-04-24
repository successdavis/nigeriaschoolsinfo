<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class DownloadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }


    /** @test */
    public function downloads_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('downloads', [
            'id', "user_id", "download_id", "download_type",
          ]), 1);
    }

    /** @test */
    public function it_has_a_method_to_record_a_download_for_a_given_module()
    {
        $this->signIn();

        $payment = $this->project->initializePayment('Project Purchase');
        $payment->markSuccessful();
    	$this->project->recordDownload($payment->id);
		
		$this->assertCount(1, $this->project->downloads);    	
    }

    /** @test */
    public function all_downloads_for_a_payment_and_a_model_can_be_retrieved_for_a_user()
    {
    	$this->signIn();
        $payment = $this->project->initializePayment('Project Purchase');
        $payment->markSuccessful();
    	$this->project->recordDownload($payment->id);

        // This code add more downloads to the table
    	$moreDownloads = create('App\Download',[],10);
		
		$downloads = $this->project->userDownloads();

		$this->assertCount(1, $downloads);
    }

    /** @test */
    public function it_return_the_download_count_for_a_payment()
    {
    	$this->signIn();
        $payment = $this->project->initializePayment('Project Purchase');
        $payment->markSuccessful();

    	$this->project->recordDownload($payment->id);
    	$this->project->recordDownload($payment->id);
     
        $paymentTwo = $this->project->initializePayment('Project Purchase');
        $paymentTwo->markSuccessful();

        $this->project->recordDownload($paymentTwo->id);

		$this->assertEquals(1, $this->project->userDownloadCounts());
    }

    /** @test */
    public function it_return_the_number_of_downloads_left()
    {
        $this->signIn();
        $payment = $this->project->initializePayment('Project Purchase');
        $payment->markSuccessful();

        $this->project->recordDownload($payment->id);
        $this->project->recordDownload($payment->id);

        $this->assertEquals(3, $this->project->downloadsAccessLeft());  
    }
}
