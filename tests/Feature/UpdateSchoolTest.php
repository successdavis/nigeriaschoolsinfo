<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdateSchoolTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->school = create('App\Schools');
    }

    /** @test */
    public function a_school_can_be_updated()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $data = $this->school->toArray();
        unset($data['id']);
        $data['name'] = 'Changed Name of School';

        $responds = $this->json('PATCH', route('schools.update',['school' => $this->school->slug]), $data)->json();

        $this->assertEquals('Changed Name of School', $this->school->fresh()->name);
    }
}
