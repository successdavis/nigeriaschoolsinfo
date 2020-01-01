<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadExamTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->exam = create('App\Exams');
    }

    /** @test */
    public function a_user_can_browse_all_exams()
    {
        $this->get('/exams')
            ->assertSee($this->exam->short_name);
    }

    /** @test */
    public function a_user_can_view_a_single_exam()
    {
        $this->get('/exams/' .  $this->exam->slug)
            ->assertSee($this->exam->name)
            ->assertSee($this->exam->description);
    }

    /** @test */
    public function a_user_can_filter_exams_by_status()
    {
        $this->exam->openRegistration();
        $examTwo = create('App\Exams');

        $response = $this->json('GET', '/exams?status=open');
        $this->assertCount(1, $response['data']);
    }

        /** @test */
    public function a_user_can_search_exams_by_name_or_short_name()
    {
        $exam = create('App\Exams', ['name' => 'Joint Admission and Matriculation Board']);
        $examTwo = create('App\Exams', ['short_name' => 'WAEC']);

        $url = 'exams?s=Admission';

        $exams = $this->json('GET', $url)->json();
        $this->assertCount(1, $exams['data']);

        $url = 'exams?s=WAEC';

        $exams = $this->json('GET', $url)->json();
        $this->assertCount(1, $exams['data']);
    }
}
