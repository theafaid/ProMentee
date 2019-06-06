<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User', ['name' => 'John Doe']);
    }

    /** @test */
    function a_user_must_have_a_username(){
        $this->assertEquals
        (
            ucfirst(Str::camel('JohnDoe')),
            $this->user->username
        );
    }

    /** @test */
    function a_user_must_have_a_unique_username(){
        $user2 = create('App\User', ['name' => 'John Doe']);

        $this->assertEquals("JohnDoe{$user2->id}", $user2->username);
    }

    /** @test */
    function a_user_must_have_a_profile_after_registration(){
        $this->post(route('register'), $this->makeUser()->toArray());

        $this->assertNotNull(User::first()->fresh()->profile);
    }

    /** @test */
    function a_user_must_be_redirect_to_select_fields_page_after_registration(){
        $this->post(route('register'), $this->makeUser()->toArray())
            ->assertStatus(200)
            ->assertJson(['status' => true]);
    }

    /** @test */
    function a_user_must_have_a_profile_after_create_new_one_using_factory(){
        $this->assertNotNull($this->user->profile);
    }

    function makeUser(){
        return make('App\User', [
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
            'gender' => 'male',
            'yob' => 2010
        ]);
    }
}
