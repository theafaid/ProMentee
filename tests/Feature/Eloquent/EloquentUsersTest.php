<?php

namespace Tests\Feature\Eloquent;

use App\User;
use Tests\TestCase;
use App\Eloquent\EloquentUsers as Users;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_user_fields_according_to_type(){
        $user = create('App\User');

        $eloquent = (new Users);

        $this->assertEmpty($eloquent->fields('edu', $user));

        $this->setDefaultFieldsToUser($user);

        $this->assertNotEmpty($eloquent->fields(null, $user));
        $this->assertNotEmpty($eloquent->fields('edu', $user));
        $this->assertNotEmpty($eloquent->fields('entmt', $user));
    }
}
