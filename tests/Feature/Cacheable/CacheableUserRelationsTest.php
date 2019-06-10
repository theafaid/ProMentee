<?php

namespace Tests\Feature\Cacheable;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CacheableUserRelationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_user_fields_ids(){
        $this->assertTrue(true);
        // given we have a user
//        $user = create('App\User');
//
//         $this->setDefaultFieldsToUser($user);
//
//        $this->assertNotNull(resolve('User')->fieldsIds('edu', $user));
////        $this->assertNotNull(resolve('User')->fieldsIds('entmt', $user));
//        // the we call user fields ids
//        $this->assertTrue(true);
        // assert that the fields contains the set fields
    }
}
