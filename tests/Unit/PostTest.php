<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function can_get_posts_feed(){
       $this->signIn();

       $this->setDefaultFieldsToUser(null, $putInCache = true);

       create('App\Post', [
           'id' => 1,
           'field_id' => auth()->user()->fields('edu')->first()->id
       ]);

       create('App\Post', [
           'id' => 2,
           'field_id' => auth()->user()->fields('entmt')->first()->id
       ]);

       create('App\Post', [
           'id' => 3,
       ]);

       $this->assertTrue(Post::feed()->pluck('id')->contains(1));
       $this->assertTrue(Post::feed()->pluck('id')->contains(2));
       $this->assertFalse(Post::feed()->pluck('id')->contains(3));
   }
}
