<?php

namespace Tests\Feature\Users;

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

       $this->get(route('selectFields'))
           ->assertStatus(302)
           ->assertRedirect(route('login'));
   }
    /** @test */
   function registered_user_can_set_his_education_and_entertainments_fields(){

       $this->assertFalse(auth()->user()->fresh()->hasSetFields());

       $this->store($mainFields = false, 3)->assertStatus(200);

       sleep(.2);

       $this->assertTrue(auth()->user()->fresh()->hasSetFields());
   }

   /** @test */
   function user_cannot_set_his_fields_more_than_once(){

       $this->assertFalse(auth()->user()->fresh()->hasSetFields());

       $this->store($mainFields = false, 3)->assertStatus(200);

       $this->store($mainFields = false, 3)
           ->assertJson(['msg' => __('javascript.something_went_wrong')])
           ->assertStatus(422);


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
