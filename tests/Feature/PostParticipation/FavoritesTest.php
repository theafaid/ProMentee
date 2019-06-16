<?php

namespace Tests\Feature\PostParticipation;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flushall();
    }

    /** @test */
    function unauthenticated_user_cannot_favorite_post()
    {
        $post = create('App\Post');

        $this->post(route('favorites.store', ['slug' => $post->slug, 'type' => 'post']))
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_favorite_post(){
        $this->signIn();

        $post = create('App\Post');

        $this->post(route('favorites.store', ['slug' => $post->slug, 'type' => 'post']))
            ->assertStatus(201);

        $this->assertDatabaseHas('favorites', [
            'user_id' => auth()->id(),
            'favorited_id' => $post->id,
            'favorited_type' => 'App\Post'
        ]);

        $this->assertCount(1, $post->favorites);

        $this->assertEquals(1, Cache::get("post.{$post->id}.favorites"));
    }
}
