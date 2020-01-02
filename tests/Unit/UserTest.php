<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
    }

    /** @test */
    public function a_user_can_be_assigned_a_role()
    {
    	$role = create('App\Role');
    	$this->user->assignRole($role->id);

    	$this->assertCount(1, $this->user->roles);
    }
}
