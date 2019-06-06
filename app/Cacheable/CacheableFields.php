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

    public function mainFields($type){
        return Cache::rememberForever('mainEduFields.all', function() use ($type){
            return $this->fields->mainFields($type);
        });
    }
}
