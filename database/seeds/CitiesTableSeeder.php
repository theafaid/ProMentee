<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('cities')->delete();
        $cities = \Config::get('cities');
        if (!$cities) {
            throw new \Exception("Cities config file doesn't exists or empty");
        }
        \DB::table('cities')->insert($cities);
    }
}
