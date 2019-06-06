<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    function a_user_has_profile(){
        $this->assertInstanceOf('App\Profile', $this->user->profile);
    }

    /** @test */
    function can_has_many_fields(){
        $this->assertInstanceOf(Collection::class, $this->user->fields);
    }

    /** @test **/
    function can_set_field(){
        $this->assertEmpty($this->user->fields);

        $fields = $this->setDefaultFieldsToUser($this->user);

        $this->assertNotNull($this->user->fields);
        $this->assertTrue($this->user->fresh()->fields->contains($fields[0]));
        $this->assertTrue($this->user->fresh()->fields->contains($fields[1]));
    }

    /** @test */
    function can_check_if_has_set_fields(){
        $this->assertFalse($this->user->hasSetFields());

        $this->setDefaultFieldsToUser($this->user);

        $this->assertTrue($this->user->fresh()->hasSetFields());
    }
}
