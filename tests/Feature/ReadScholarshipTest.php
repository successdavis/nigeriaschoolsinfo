<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadScholarshipTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->scholarship = create('App\Scholarship');
    }

        /** @test */
    public function a_user_can_browse_all_scholarships()
    {
        $response = $this->json('GET', '/latest-scholarships-opportunities-for-application')->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_user_can_view_a_single_scholarship()
    {
        $this->get('/scholarship/' .  $this->scholarship->slug)
            ->assertSee($this->scholarship->name)
            ->assertSee($this->scholarship->description);
    }

    /** @test */
    public function a_user_can_filter_scholarships_by_status()
    {
        $this->scholarship->openApplication();
        $scholarshipTwo = create('App\Scholarship');

        $response = $this->json('GET', '/latest-scholarships-opportunities-for-application?status=open');
        $this->assertCount(1, $response['data']);
    }

        /** @test */
    public function a_user_can_search_scholarships_by_name_or_description()
    {
        $scholarship = create('App\Scholarship', ['title' => 'Stechmax Offering Scholarship']);
        $scholarshipTwo = create('App\Scholarship', ['description' => 'some really long description here']);

        $url = 'latest-scholarships-opportunities-for-application?s=Stechmax';

        $scholarship = $this->json('GET', $url)->json();
        $this->assertCount(1, $scholarship['data']);

        $url = 'latest-scholarships-opportunities-for-application?s=description';

        $scholarship = $this->json('GET', $url)->json();
        $this->assertCount(1, $scholarship['data']);
    }

}
