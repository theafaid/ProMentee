<?php


namespace App\Cacheable;

use App\Libs\Fields;
use Illuminate\Support\Facades\Cache;

class CacheableFields implements Fields
{
    protected $fields;

    public function __construct($fields){
        $this->fields = $fields;
    }

    /**
     * Fetch main fields from caching according to it's type
     * @param $type
     * @return mixed
     */
    public function mainFields(){

        $key = "mainFields";

        $key = app()->runningUnitTests() ? "{$key}_testing" : $key;

        return Cache::driver('redis')->rememberForever($key, function(){
            return $this->fields->mainFields();
        });
    }
}
