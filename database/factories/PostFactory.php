<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker){
    $title = $faker->text(5);
    return [
        'title' => $title,
        'body' => $faker->paragraph(20),
        'slug' => \Str::slug($title),
        'type' => $faker->randomElement(['advice', 'information', 'request', 'idea', 'other']),
        'user_id' => function(){
            if(app()->runningUnitTests()) return factory('App\User')->create()->id;

            $users = \App\User::all();

            return count($users) ? $users->random()->id : factory('App\User')->create()->id;
        },

        'field_id' => function(){
            if(app()->runningUnitTests()) return factory('App\Field')->create()->id;

            $fields = \App\Field::all();

            return count($fields) ? $fields->random()->id : factory('App\Field')->create()->id;
        }
    ];
});
