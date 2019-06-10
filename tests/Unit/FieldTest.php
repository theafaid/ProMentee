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
        $subfield = $this->createField($mainField = false);

        $this->assertInstanceOf('App\Field', $subfield->parent);
    }

    /** @test */
    function field_might_has_subfields(){

        $subfields = $this->createField($mainField = false, 3);
        $mainField = $subfields->random()->parent;

        $this->assertInstanceOf(Collection::class, $mainField->children);

        $this->assertInstanceOf('App\Field', $mainField->children->random());
    }

    /** @test */
    function can_check_if_has_parent(){

        $subfield = $this->createField($mainField = false);

        $this->assertTrue($subfield->parent->isParent());
        $this->assertFalse($subfield->isParent());
    }

    /** @test */
    function it_has_many_posts(){
        $field = $this->createField(false);
        $this->assertInstanceOf(Collection::class, $field->posts);
    }

    /** @test */
    function can_create_post(){
        $this->signIn();

        $field = $this->createField(false);
        $post = make('App\Post', ['id' => 1]);

        $field->newPost($post->toArray());

        $field = $field->fresh();

        $this->assertEquals(1, $field->posts()->count());

        $this->assertEquals($post->id, $field->posts()->first()->id);
    }
}
