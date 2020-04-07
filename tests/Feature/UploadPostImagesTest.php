<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class UploadPostImagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_upload_post_images()
    {
        $this->withExceptionHandling();

        $this->json('POST', route('posts.images'))
            ->assertStatus(403);
    }

    /** @test */
    public function a_valid_image_must_be_provided()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $this->json('POST', route('posts.images'), ['logo' => 'not-an-image'])
            ->assertStatus(422);
    }

    /** @test */
    public function a_non_administrator_cannot_attach_a_exams_logo()
    {
        $this->withExceptionHandling()->signIn();

        Storage::fake('public');

        $this->json('POST', route('posts.images'), ['logo' => $file = UploadedFile::fake()->image('logo.jpg')])->assertStatus(403);
    }

    /** @test */
    public function an_admin_can_upload_post_images()
    {
        $this->withExceptionHandling();
        
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        Storage::fake('public');

        $responds = $this->json('POST', route('posts.images'), ['file' => $file = UploadedFile::fake()->image('logo.jpg')]);

        Storage::disk('public')->assertExists('posts/' . 'logo.jpg');
    }

}
