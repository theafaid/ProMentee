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
}
