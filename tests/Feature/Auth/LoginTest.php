<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User', ['password' => bcrypt('test1234')]);
    }

    /** @test */
    function un_authenticated_user_can_login_using_email(){

        $this->login('email')->assertStatus(200)
            ->assertJson(['redirectTo' => route('home')]);
    }

    /** @test */
    function un_authenticated_user_can_login_using_username(){
        $this->login('username')->assertStatus(200)
            ->assertJson(['redirectTo' => route('home')]);
    }

    function login($loginName = 'email'){
        return $this->post(route('login'), [
            'loginName' => $this->user->$loginName,
            'password' => 'test1234'
        ]);
    }
}
