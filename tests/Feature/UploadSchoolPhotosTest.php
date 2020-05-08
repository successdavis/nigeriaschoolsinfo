<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class UploadSchoolPhotosTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->schoolphoto = create('App\Schoolphoto');
        $this->school = create('App\Schools');
    }


    /** @test */
    public function an_admin_can_upload_a_photo_to_a_school()
    {
        // $this->withExceptionHandling();
        
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);


        Storage::fake('public');

        $data = [
            'caption'       => 'Front view',
            'description'   => 'This is the front view of the school',
            'school'        => $this->school->id,
            'file'          => $file = UploadedFile::fake()->image('file.jpg')
        ];


        $responds = $this->json('POST', route('photos.store', ['schools' => $this->school->slug]), $data);

        Storage::disk('public')->assertExists('schools/photos/' . $this->school->slug .'-front-view.jpg');
    }
}
