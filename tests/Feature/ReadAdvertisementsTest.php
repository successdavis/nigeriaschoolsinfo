<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadAdvertisementsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->advertisement = factory('App\Advertisements')->states('active')->create();
    }

    /** @test */
    public function an_admin_can_retrieve_all_active_advertisements()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $inAdvertisements = create('App\Advertisements');

        $request = $this->json('GET', route('advertisements.index'))->json();

        $this->assertCount(1, $request);
    }
}
