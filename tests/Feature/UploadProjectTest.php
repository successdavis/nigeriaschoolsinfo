<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UploadProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->project = create('App\Project');
    }

    /** @test */
    public function a_material_can_be_uploaded_to_a_project()
    {
        // $this->withExceptionHandling();
        
        $this->signIn();

        Storage::fake('public');

        $responds = $this->json('POST', route('project.upload', ['project' => $this->project->slug]), ['file' => $file = UploadedFile::fake()->image('logo.jpg')]);

        $this->assertEquals(asset('storage/projects/'.$this->project->slug.'.jpg'), $this->project->fresh()->download_path);

        Storage::disk('public')->assertExists('projects/' . $this->project->slug . '.jpg');
    }
}
