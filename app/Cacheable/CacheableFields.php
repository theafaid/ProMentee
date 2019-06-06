<?php


namespace App\Cacheable;

use Illuminate\Support\Facades\Redis;

class CacheableFields
{
    protected $fields;

    public function __construct($fields){
        $this->fields = $fields;
    }

    public function mainEduFields(){
        if($value = Redis::get('mainEduFields.all')){
            return $value;
        }

        Redis::setex('mainEduFields.all', 60*60, $this->fields->mainEduFields()->toJson());

        return $value;
    }

    public function mainEntmtFields(){
        if($value = Redis::get('mainEntmtFields.all')){
            return $value;
        }

        return Redis::setx('mainEntmtFields.all', 60*60, $this->fields->mainEntmtFields()->toJson());
    }
}
