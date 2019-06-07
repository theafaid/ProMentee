<?php

namespace Tests\Feature\Post;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function un_authenticated_user_cannot_see_index_posts_page(){
        $this->get(route('posts.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function user_whose_fields_have_not_been_set_cannot_see_posts_index_page(){
        $this->signIn();
        $this->get(route('posts.index'))
            ->assertRedirect(route('setFields'));
    }

    /** @test */
    function user_whose_fields_have_been_set_can_see_posts_index_page(){
        $this->signIn();

        $this->setDefaultFieldsToUser();

        $this->get(route('posts.index'))
            ->assertStatus(200)
            ->assertViewIs('posts.index');
    }
}
