<?php

namespace Tests\Feature\Home;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    function unauthenticated_user_must_see_welcome_view_when_he_try_to_go_to_root_url(){
        $this->logout();

        $this->get(route('home'))
            ->assertViewIs('welcome');
    }

    /** @test */
    function authenticated_user_who_has_not_selected_his_fields_cannot_see_home_page(){
        $this->signIn();

        $this->get(route('home'))
            ->assertRedirect(route('setFields'));

        $this->get(route('setFields'))
            ->assertStatus(200)
            ->assertViewIs('set_fields');
    }

    /** @test */
    function authenticated_user_who_has_selected_his_fields_can_see_home_page(){
        $this->signIn();

        $this->setDefaultFieldsToUser();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('home');

        $this->get(route('setFields'))
            ->assertStatus(404);

    }
}
