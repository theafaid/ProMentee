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

        $eduField = $this->createField($mainField = false, 1, 'edu');
        $entmtField = $this->createField($mainField = false, 1, 'entmt');

        $this->user->setField($eduField);
        $this->user->setField($entmtField);

        $this->assertNotNull($this->user->fields);
        $this->assertTrue($this->user->fresh()->fields->contains($entmtField));
        $this->assertTrue($this->user->fresh()->fields->contains($eduField));
    }
}
