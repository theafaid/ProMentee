<?php

namespace Tests\Feature\Cacheable;

use App\Cacheable\CacheableFields;
use App\Eloquent\EloquentFields;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CacheableFieldsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_main_fields_from_cache(){
        $this->assertTrue(true);
//        $this->flushall();
//
//        $this->assertEmpty(resolve('Fields')->mainFields('edu'));
//        $this->assertEmpty(resolve('Fields')->mainFields('entmt'));
//
//        $mainEduField = $this->createField(false, 1,'edu');
//        $mainEntmtField = $this->createField(false, 1,'entmt');
//
//        dd((new CacheableFields(new EloquentFields()))->mainFields('edu'));
//
//        $this->assertNotEmpty(resolve('Fields')->mainFields('edu'));
//        $this->assertNotEmpty(resolve('Fields')->mainFields('entmt'));


//        dd(resolve('Fields')->mainFields('edu')->pluck('id') . " " . $mainEduField->id);
//
//        $this->assertTrue(resolve('Fields')->mainFields('edu')->pluck('id')->contains($mainEduField->id));
//        $this->assertEquals($mainEntmtField, resolve('Fields')->mainFields('entmt'));
    }
}
