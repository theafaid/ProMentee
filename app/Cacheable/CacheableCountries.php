<?php
namespace App\Cacheable;

use Illuminate\Support\Facades\Cache;

class  CacheableCountries {

    protected $countries;

    public function __construct($countries)
    {
        $this->countries = $countries;
    }

    /**
     * Fetch App supported countries from cache
     * @return mixed
     */
    public function supported(){
        return Cache::rememberForever('supportedCountries', function(){
            return $this->countries->supported();
        });
    }

}
