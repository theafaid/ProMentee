<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function field_might_has_parent(){
        $mainField = create('App\Field'); // parent is null
        $subField  = create('App\Field', ['parent_id' => $mainField]);

        $this->assertInstanceOf('App\Field', $subField->parent);
    }

    /** @test */
    function field_might_has_subfields(){
        $mainField = create('App\Field'); // parent is null

        create('App\Field', ['parent_id' => $mainField], 3);

        $this->assertInstanceOf(Collection::class, $mainField->children);

        $this->assertInstanceOf('App\Field', $mainField->children->random());
    }
}
