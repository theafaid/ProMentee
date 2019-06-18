<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\City::class, function (Faker $faker) {
    $cities = config('cities');

    return $cities[array_rand($cities)];
});
