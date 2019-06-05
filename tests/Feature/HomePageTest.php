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
    function authenticated_user_who_has_not_selected_his_fields_cannot_see_home_page(){
        $this->signIn();

        $this->get(route('welcome'))
            ->assertRedirect(route('selectFields'));

        $this->get(route('selectFields'))
            ->assertStatus(200)
            ->assertViewIs('select_fields');
    }

    /** @test */
    function authenticated_user_who_has_selected_his_fields_can_see_home_page(){
        $this->signIn();

        $eduField   = $this->createField(false, 1, 'edu');
        $entmtField =  $this->createField(false, 1, 'entmt');

        auth()->user()->setField($eduField);
        auth()->user()->setField($entmtField);

        $this->get(route('welcome'))
            ->assertStatus(200)
            ->assertViewIs('home');

        $this->get(route('selectFields'))
            ->assertStatus(404);

    }
}
