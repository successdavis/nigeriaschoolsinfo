<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class UpdatePostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->post = create('App\Post');
    }

    /** @test */
    public function an_admin_can_update_a_post()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);


        $this->json('patch', '/posts/updatepost/' . $this->post->slug, [
            'title'     => 'hello world', 
            'body'      => 'The quick brown fox',
            'meta_description'  => 'Proin faucibus arcu quis ante. Morbi mattis ullamcorper velit. Curabitur a felis in nunc fringilla tristique. Suspendisse enim turpis, dictum sed, id',
            'module'    => 'Schools',
            'module_id' => '1'
        ])->json();

        $this->assertEquals($this->post->fresh()->title, 'hello world');
    }

    /** @test */
    public function an_admin_can_update_post_category_and_related_model()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $course = create('App\Courses');

        $this->json('patch', '/posts/updatepost/' . $this->post->slug, [
            'title'       => 'hello world', 
            'body'        => 'The quick brown fox',
            'meta_description'  => 'Proin faucibus arcu quis ante. Morbi mattis ullamcorper velit. Curabitur a felis in nunc fringilla tristique. Suspendisse enim turpis, dictum sed, id',
            'module'      => 'Courses',
            'module_id'   => '1'
        ])->json();

        $this->assertInstanceOf("App\Courses", $this->post->fresh()->source);
    }

        /** @test */
    public function an_approved_admin_can_mark_a_post_as_followup()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $this->patch($this->post->slug . '/followup', []);

        $this->assertTrue($this->post->fresh()->isFollowUp());
    }

        /** @test */
    public function an_admin_can_unmark_a_post_as_followup()
    {
        $user = create('App\User');
        $role = create('App\Role',['name' => 'admin']);

        $user->assignRole($role->id);
        $this->signIn($user);

        $this->delete($this->post->slug . '/followup', []);

        $this->assertFalse($this->post->fresh()->isFollowUp());
    }



    /** @test */
    public function it_can_be_soft_deleted_by_approved_persons()
    {
        $responds = $this->json('delete', $this->post->slug . '/delete')->json();

        $this->assertSoftDeleted('posts', ['slug' => $this->post->slug]);
    }
}
