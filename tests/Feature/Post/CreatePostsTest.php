<?php

namespace Tests\Feature\Post;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_user_can_see_create_post_page(){
        $this->signIn();

        $this->setDefaultFieldsToUser();

        $this->get(route('posts.create'))
            ->assertStatus(200)
            ->assertViewIs('posts.create');
    }

    /** @test */
    function authenticated_user_can_create_new_post(){
        $this->flushall();

        $this->signIn();

        $this->setDefaultFieldsToUser(null, true);

        $userFields = resolve('User')->fieldsIds();

        $post = make('App\Post',[
            'field_id' => $userFields[array_rand($userFields)]
        ]);


        $this->post(route('posts.store'), $post->toArray())
            ->assertStatus(200)
            ->assertJson(['msg' => __('javascript.post_created')]);

        $this->assertDatabaseHas('posts', ['slug' => $post->slug]);
    }
}
