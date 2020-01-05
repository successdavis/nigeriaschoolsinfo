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
        $respond = $this->json('GET', '/schools')->json();
            $this->assertCount(1, $respond['data']);
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

        $respond = $this->json('GET', route('schoolsInType',['schooltype' => $type->slug]));
        $this->assertCount(1, $respond['data']);
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

    /** @test */
    public function a_user_can_browse_all_schools_still_offering_admission()
    {
        $type = $this->school->SchoolType;
        $this->school->openAdmission();
        $school = create('App\Schools',['school_type_id' => $type->id]);

        $url = 'schools/type/' . $type->slug . '?a=admitting';

        $schools = $this->json('GET', $url)->json();
        $this->assertCount(1, $schools['data']);
    }

    /** @test */
    public function a_user_can_search_schools_by_name_or_description()
    {
        $school = create('App\Schools', ['name' => 'University of Calabar']);
        $schoolTwo = create('App\Schools', ['description' => 'Calabar is a good town']);

        $url = 'schools?s=University';

        $schools = $this->json('GET', $url)->json();
        $this->assertCount(1, $schools['data']);

        $url = 'schools?s=Calabar';

        $schools = $this->json('GET', $url)->json();
        $this->assertCount(2, $schools['data']);
    }

    /** @test */
    public function a_user_can_search_schools_by_short_name()
    {
        $school = create('App\Schools', ['name' => 'University of Calabar']);
        $schoolTwo = create('App\Schools', ['short_name' => 'JAMB']);

        $url = 'find/school?sn=JAMB';

        $schools = $this->json('GET', $url)->json();
        $this->assertCount(1, $schools['data']);
    }

    // /** @test */
    // public function a_user_can_retreive_all_schools_offered_by_a_course()
    // {
    //     $course = create('App\Courses');
    //     $course->attachSchool($this->school->id);

    //     $response = $this->json('GET', '/schools/courses')->json();
    //     $this->assertCount(1, $response['data']);
    // }
}