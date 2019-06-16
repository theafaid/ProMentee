<?php

namespace Tests\Feature\Post;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowPostTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function unauthenticated_user_cannot_see_single_post(){
        $post = create('App\Post');

        $this->get(route('posts.show', $post->slug))
            ->assertRedirect(route('login'));
   }

   /** @test */
   function authenticated_user_can_see_single_post(){
       $this->signIn();

       $this->setDefaultFieldsToUser();

       $post = create('App\Post');

       $this->get(route('posts.show', $post->slug))
           ->assertStatus(200);
   }
}
