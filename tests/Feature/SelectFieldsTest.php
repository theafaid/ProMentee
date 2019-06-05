<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectFieldsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function a_user_can_see_this_selectFields_page_only_if_authenticated_and_has_no_selected_fields(){
       $this->get(route('selectFields'))
           ->assertStatus(404);

        $this->signIn();
       $this->get(route('selectFields'))
           ->assertStatus(200)
           ->assertViewIs('select_fields');

       $edumainField = create('App\Field'); // parent is null

        create('App\Field', ['parent_id' => $edumainField], 3);

   }
}
