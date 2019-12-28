<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadSChoolTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->school = create('App\Schools');
    }

    /** @test */
    public function a_user_can_browse_all_schools()
    {
        $this->get('/schools')
            ->assertSee($this->school->name);
    }

    /** @test */
    public function a_user_can_view_a_single_school()
    {
        $this->get('/schools/' .  $this->school->slug)
            ->assertSee($this->school->name)
            ->assertSee($this->school->description);
    }

        /** @test */
    public function a_user_can_browse_schools_by_school_type()
    {
        $type = create('App\SchoolType');
        $schoolInType = create('App\Schools', ['school_type_id' => $type->id]);
        $schoolNotInType = create('App\Schools');

        $this->get(route('schoolsInType',['schooltype' => $type->slug]))
            ->assertSee($schoolInType->name)
            ->assertDontSee($schoolNotInType->name);
    }

        /** @test */
    public function a_user_can_browse_schools_by_school_sponsored()
    {
        $type = $this->school->SchoolType;
        $sponsored = $this->school->sponsored;
        
        $schoolInType = create('App\Schools', ['school_type_id' => $type->id]);
        $schoolInType2 = create('App\Schools', ['school_type_id' => $type->id]);

        $url = 'schools/type/' . $type->slug . '?q=' . $sponsored->slug;

        $schools = $this->json('GET', $url)->json();


        $this->assertCount(1, $schools['data']);
    }
}