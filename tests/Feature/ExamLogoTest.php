<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class ExamLogoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->exam = create('App\Exams');
    }

    /** @test */
    public function an_unathenticated_users_cannot_upload_exam_logo()
    {
        $this->withExceptionHandling();

        $this->json('POST', route('exam.logo', ['exams' => $this->exam->slug]))
            ->assertStatus(403);
    }

    /** @test */
    public function a_valid_logo_must_be_provided()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $this->json('POST', route('exam.logo', ['exams' => $this->exam->slug]), ['logo' => 'not-an-image'])
            ->assertStatus(422);
    }

    /** @test */
    public function a_non_administrator_cannot_attach_a_exams_logo()
    {
        $this->withExceptionHandling()->signIn();

        Storage::fake('public');

        $this->json('POST', route('exam.logo', ['exams' => $this->exam->slug]), ['logo' => $file = UploadedFile::fake()->image('logo.jpg')])->assertStatus(403);
    }

    /** @test */
    public function an_admin_can_attach_an_exam_logo()
    {
        $this->withExceptionHandling();
        
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        Storage::fake('public');

        $this->json('POST', route('exam.logo', ['exams' => $this->exam->slug]), ['logo' => $file = UploadedFile::fake()->image('logo.jpg')]);

        $this->assertEquals(asset('storage/exams/logos/'.$file->hashName()), $this->exam->fresh()->logo_path);

        Storage::disk('public')->assertExists('exams/logos/' . $file->hashName());
    }

    /** @test */
    public function a_default_logo_should_be_returned_when_no_exam_logo_is_assigned()
    {
        $this->assertEquals(asset('storage/exams/logos/default.jpg'), $this->exam->fresh()->logo_path);
    }
}
