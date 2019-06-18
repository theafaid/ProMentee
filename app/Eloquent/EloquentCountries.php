<?php
namespace App\Eloquent;

use App\Country;

class EloquentCountries {

    /**
     * Fetch all supported countries in app
     * @return mixed
     */
    public function supported(){
        return Country::where('supported', true)->get();
    }
}
