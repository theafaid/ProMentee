<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_has_profile(){
        $user = create('App\User');
        $this->assertInstanceOf('App\Profile', $user->profile);
    }

    /** @test */
    function can_has_many_fields(){
        $user = create('App\User');

        $types = ['edu', 'entmt', 'all'];

        $this->assertInstanceOf(Collection::class, $user->fields);
    }

    /** @test **/
    function can_set_field(){
        $user = create('App\User');

        $this->assertEmpty($user->fields);

        $eduField = $this->createField('edu');
        $entmtField = $this->createField('entmt');

        $user->setField($eduField);
        $user->setField($entmtField);

        $this->assertNotNull($user->fields);
        $this->assertTrue($user->fresh()->fields->contains($entmtField));
        $this->assertTrue($user->fresh()->fields->contains($eduField));
    }
}
