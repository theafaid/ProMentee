<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function un_authenticated_user_must_see_welcome_view_when_he_try_to_go_to_root_url(){
        $this->get(route('welcome'))
            ->assertViewIs('welcome');
    }

    /** @test */
    function authenticated_user_must_see_home_view_when_he_try_to_go_to_root_url(){
        $this->signIn();

        $this->get(route('welcome'))
            ->assertViewIs('home');
    }
}
