<?php

namespace Tests\Feature\Eloquent;

use Tests\TestCase;
use App\Eloquent\EloquentUserRelations as Users;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentUsersRelationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_user_fields_according_to_type(){
        $user = create('App\User');

        $eloquent = (new Users);

        $this->assertEmpty($eloquent->fieldsIds('edu', $user));

        $this->setDefaultFieldsToUser($user);

        $this->assertNotEmpty($eloquent->fieldsIds(null, $user));
        $this->assertNotEmpty($eloquent->fieldsIds('edu', $user));
        $this->assertNotEmpty($eloquent->fieldsIds('entmt', $user));
    }
}
