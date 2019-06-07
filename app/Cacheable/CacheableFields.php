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
    public function mainFields($type){

        $key = "main" . ucfirst($type) . "Fields.all";

        $key = app()->runningUnitTests() ? "{$key}_testing" : '';

        return Cache::rememberForever($key, function() use ($type){
            return $this->fields->mainFields($type);
        });
    }
}
