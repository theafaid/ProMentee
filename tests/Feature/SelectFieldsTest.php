<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectFieldsTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   function return_true(){
       $this->assertFalse(false);
   }
}
