<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectFieldsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function registered_user_can_set_his_education_and_entertainments_fields(){
        $this->signIn();

       $this->assertFalse(auth()->user()->fresh()->hasSelectedFields());

       $eduFields = $this->createField($mainField = false, 3, 'edu');
       $entmtFields = $this->createField($mainField = false, 3, 'entmt');

       $this->withoutExceptionHandling();

       $this->post(route('user.fields.store'), [
           'eduFields' => $eduFields->pluck('id')->toArray(),
           'entmtFields' => $entmtFields->pluck('id')->toArray(),
       ])->assertStatus(200);

       sleep(.25);

       $this->assertTrue(auth()->user()->fresh()->hasSelectedFields());
   }
}
