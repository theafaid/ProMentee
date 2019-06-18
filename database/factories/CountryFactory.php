<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Country::class, function (Faker $faker) {
    $countries = config('countries');
    return $countries[array_rand($countries)];
});
