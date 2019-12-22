<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class SchoolLogoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->school = create('App\Schools');
    }

    /** @test */
    public function an_unathenticated_users_cannot_upload_logo()
    {
        $this->withExceptionHandling();

        $this->json('POST', route('school.logo', ['school' => $this->school->slug]))
            ->assertStatus(401);
    }

     /** @test */
    public function a_valid_logo_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', route('school.logo', ['school' => $this->school->slug]), ['logo' => 'not-an-image'])
            ->assertStatus(422);
    }

    /** @test */
    public function a_non_administrator_cannot_attach_a_school_logo()
    {
        $this->withExceptionHandling()->signIn();

        Storage::fake('public');

        $this->json('POST', route('school.logo', ['school' => $this->school->slug]), ['logo' => $file = UploadedFile::fake()->image('logo.jpg')])->assertStatus(403);
    }


    /** @test */
    public function an_admin_can_attach_a_school_logo()
    {
        $this->signIn(factory('App\User')->state('administrator')->create());

        Storage::fake('public');

        $this->json('POST', route('school.logo', ['school' => $this->school->slug]), ['logo' => $file = UploadedFile::fake()->image('logo.jpg')]);

        $this->assertEquals(asset('storage/schools/logos/'.$file->hashName()), $this->school->fresh()->logo_path);

        Storage::disk('public')->assertExists('schools/logos/' . $file->hashName());
    }

    /** @test */
    public function a_default_logo_should_be_returned_when_no_school_logo_is_assigned()
    {
        $this->assertEquals(asset('storage/schools/logos/default.jpg'), $this->school->fresh()->logo_path);
    }
}
