<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('countries')->delete();
        $countries = \Config::get('countries');
        if (!$countries) {
            throw new \Exception("Countries config file doesn't exists or empty");
        }
        \DB::table('countries')->insert($countries);
    }
}
