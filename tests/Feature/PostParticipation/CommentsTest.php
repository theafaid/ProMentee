<?php

namespace Tests\Feature\PostParticipation;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flushall();
    }

    /** @test */
    function unauthenticated_user_may_not_add_comment_in_any_post(){

        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $post = create('App\Post');

        $this->post(route('comments.store', ['model' => $post->slug, 'type' => 'post']), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_authenticated_user_may_participate_in_post(){

        $this->signIn();

        $post = create('App\Post');

        $this->withoutExceptionHandling();
        $this->post(route('comments.store', ['model' => $post->slug, 'type' => 'post']), ['body' => 'comment body'])
            ->assertStatus(201);
        $this->assertDatabaseHas('comments', ['body' => 'comment body']);

        $this->assertCount(1 ,$post->fresh()->comments);

        $this->assertEquals(1, Cache::get("post.{$post->id}.comments"));

    }
}
