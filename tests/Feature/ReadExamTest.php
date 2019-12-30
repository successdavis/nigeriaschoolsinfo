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
}
