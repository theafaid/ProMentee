<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => \Str::slug($name),
        'type' => $faker->randomElement(['edu', 'entmt']),
        'parent_id' => function (){
            if(\App\Category::count()){
                return \App\Category::all()->random()->id;
            }
        }
    ];
});
