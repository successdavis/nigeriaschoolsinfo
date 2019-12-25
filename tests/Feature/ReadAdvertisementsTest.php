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
    public function it_a_non_admin_cannot_retrieve_advertisements()
    {
        $this->withExceptionHandling();

        $this->json('GET', route('advertisements.index'))
            ->assertStatus(403);

    }

    /** @test */
    public function an_admin_can_retrieve_all_active_advertisements()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $inAdvertisements = create('App\Advertisements');

        $request = $this->json('GET', route('advertisements.index'))->json();

        $this->assertCount(1, $request);
    }
}
