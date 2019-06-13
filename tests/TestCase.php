<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Cache;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(){
        $this->actingAs(create('App\User'));

        return $this;
    }

    public function logout(){
        $this->get(route('logout'));
    }

    public function createField($mainField = false,  $count = 1, $type = 'edu'){

        $count =  $count == 1 ? null : $count;

        $parent = create('App\Field', ['type' => $type, 'parent_id' => null], null);

        if($mainField){
            return $parent;
        }

        return create('App\Field', ['type' => $type, 'parent_id' => $parent->id], $count);
    }

    /**
     * Create two main field & one sub fields for every single main field
     * @return array
     */
    public function eeFields(){
         return [
            $this->createField(false, 1, 'edu'),
            $this->createField(false, 1, 'entmt')
         ];
    }

    public function setDefaultFieldsToUser($user = null, $storeInCache = false){

        $user  = $user ?: auth()->user();

        $fields = $this->eeFields();

        foreach($fields as $field){
            $user->setField($field);
        }

        $storeInCache ? $this->storeUserFieldsInCache($user) : '';

        return $fields;
    }

    public function flushall(){
        \Cache::flush();
    }

    protected function storeUserFieldsInCache($user){
        $types = ['edu', 'entmt'];

        foreach($types as $type){
            Cache::forever(
                "user.{$user->id}.{$type}Fields",
                [$user->fields($type)->first()->id]
            );
        }
    }
}
