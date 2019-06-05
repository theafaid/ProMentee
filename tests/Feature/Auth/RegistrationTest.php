<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_must_have_a_username(){
        $user = create('App\User', ['name' => 'john Doe']);

        $this->assertEquals
        (
            ucfirst(Str::camel('JohnDoe')),
            $user->username
        );
    }

    /** @test */
    function a_user_must_have_a_unique_username(){

        create('App\User', ['name' => 'John Doe']);
        $user = create('App\User', ['name' => 'John Doe']);

        $this->assertEquals("JohnDoe{$user->id}", $user->username);
    }

    /** @test */
    function a_user_must_have_a_profile_after_registration(){
        $user = make('App\User', [
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
            'gender' => 'male',
            'yob' => 2010
        ]);

        $this->post(route('register'), $user->toArray());

        $this->assertNotNull(User::first()->fresh()->profile);
    }

    /** @test */
    function a_user_must_be_redirect_to_select_fields_page_after_registration(){
        $user = make('App\User', [
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
            'gender' => 'male',
            'yob' => 2010
        ]);

        $this->post(route('register'), $user->toArray())
            ->assertRedirect(route('selectFields'));
    }

    /** @test */
    function a_user_must_have_a_profile_after_create_new_one_using_factory(){
        $user = create('App\User');

        $this->assertNotNull($user->profile);
    }

}
