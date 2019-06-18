<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {

        $countries = \Config::get('countries');
        if (!$countries) {
            throw new \Exception("Countries config file doesn't exists or empty");
        }
        \DB::table('countries')->delete();
        \Cache::pull('countries');
        \DB::table('countries')->insert($countries);
        \Cache::forever('supportedCountries', (new \App\Eloquent\EloquentCountries)->supported());
    }
}
