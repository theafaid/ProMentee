<?php

namespace Tests\Feature\Auth;

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
}
