<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function category_might_has_parent(){
        $mainCategory = create('App\Category'); // parent is null
        $subCategory  = create('App\Category', ['parent_id' => $mainCategory]);

        $this->assertInstanceOf('App\Category', $subCategory->parent);
    }

    /** @test */
    function category_might_has_children(){
        $mainCategory = create('App\Category'); // parent is null

        create('App\Category', ['parent_id' => $mainCategory], 3);

        $this->assertInstanceOf(Collection::class, $mainCategory->children);

        $this->assertInstanceOf('App\Category', $mainCategory->children->random());
    }
}
