<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User',
            [
                'name' => 'John Doe',
                'username' => 'JohnDoe'
            ]
        );
    }

    /** @test */
    function a_user_must_have_a_unique_username(){
        $user2 = create('App\User', ['name' => 'John Doe', 'username' => 'JohnDoe']);

        $this->assertEquals(
            "JohnDoe" . substr(time(), 6, 4),
            $user2->username
        );
    }

    /** @test */
    function a_user_must_have_a_profile_after_registration(){
        $user = User::first();

        $this->assertNotNull($user->profile);

        $date = date('Y') - 10 ;

        $this->assertEquals(
            $date,
            $user->profile->yob
        );

        $this->assertEquals('male', $user->profile->gender);

    }

    /** @test */
    function a_user_can_register(){
        $user = $this->makeUser();
        $this->post(route('register'), $user->toArray())
            ->assertStatus(200)
            ->assertJson(['redirectTo' => route('setFields')])
            ->assertSessionHas('success', __('site.registered_successfully', ['name' => $user->name]));

        $this->assertNotNull(auth()->user()->profile);
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
