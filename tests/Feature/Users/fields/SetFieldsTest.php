<?php

namespace Tests\Feature\Users;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetFieldsTest extends TestCase
{
   use RefreshDatabase;

   protected function setUp(): void
   {
       parent::setUp();

       $this->signIn();
   }

   /** @test */
   function unauthenticated_user_cannot_see_set_fields_page(){
       $this->logout();

      $this->endpoint(false, false)
           ->assertStatus(302)
           ->assertRedirect(route('login'));
   }

    /** @test */
    function user_whose_fields_have_not_been_set_can_see_set_fields_page(){
        $this->endpoint(true, false)
            ->assertStatus(200)
            ->assertViewIs('user.fields.set_fields');
    }

    /** @test */
    function user_whose_fields_have_been_set_cannot_see_set_fields_page(){
       $this->endpoint(true, true)->assertStatus(403);
    }

    /** @test */
   function registered_user_can_set_his_education_and_entertainments_fields(){
       $user = auth()->user();

       $this->assertFalse($user->fresh()->hasSetFields());

       $this->store($mainFields = false, 3)->assertStatus(200);

       sleep(.2);

       $this->assertTrue($user->fresh()->hasSetFields());

       $types = ["eduFields", "entmtFields"];

       foreach($types as $type){
           $this->assertTrue(Cache::has("user.{$user->id}.{$type}"));
           $this->assertCount(3, Cache::get("user.{$user->id}.{$type}"));
       }
   }

   /** @test */
   function user_cannot_set_his_fields_more_than_once(){

       $this->assertFalse(auth()->user()->fresh()->hasSetFields());

       $this->store($mainFields = false, 3)->assertStatus(200);

       $this->store($mainFields = false, 3)
           ->assertStatus(403);
   }

   /** @test */
   function set_fields_requires_subfields_not_main(){
      $this->store($mainFields = true, 1)
          ->assertSessionHasErrors(['eduFields.*', 'entmtFields.*']);
   }

   /** @test */
    function set_fields_requires_at_most_three_education_fields(){
        $this->store($mainFields = false, 4)
            ->assertSessionHasErrors(['eduFields']);
    }

    /** @test */
    function set_Fields_requires_that_subfield_type_must_be_the_same_for_the_parent(){

        $parent = $this->createField(true, 1, 'edu');

        $subField = create('App\Field',
            [
                'parent_id' => $parent->id,
                'type' => 'entmt'
            ], 1)->pluck('id')->toArray();

        $data = [
            'eduFields' => $subField,
        ];

        $this->post(route('user.fields.store'), $data)
            ->assertSessionHasErrors(['eduFields.*', 'entmtFields']);
    }

    function endpoint($authenticated = false, $hasSetFields = false){
        if(! $authenticated) $this->logout();

        if($hasSetFields) $this->setDefaultFieldsToUser(auth()->user());

        return $this->get(route('setFields'));
    }

    function store($main = false, $count){
        return $this->post(
            route('user.fields.store'),
            $this->customFields($main, $count)
        );
    }

    function customFields($main, $count){
        return [
            'eduFields'   => $this->createField($main, $count, 'edu')->pluck('id')->toArray(),
            'entmtFields'   => $this->createField($main, $count, 'entmt')->pluck('id')->toArray(),
        ];
    }
}
