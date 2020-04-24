<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreatePostcategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = create('App\Postcategory');
    }

    /** @test */
    public function an_administrator_can_create_a_new_postcategory()
    {   
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $category = make('App\Postcategory');

        $this->json('post', route('category.store'), $category->toArray())
            ->assertStatus(201);
    }

    /** @test */
    public function a_non_administrator_cannot_create_a_new_category()
    {   
        $category = make('App\Postcategory');

        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');
        $this->json('post', route('category.store'), $category->toArray())
            ->assertStatus(201);
    }
}
