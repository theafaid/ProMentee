<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Seeder;
use App\Field;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redis::flushall();

        $engineering = Field::create([
            'name' => 'Engineering',
            'slug' => 'engineering',
            'parent_id' => null,
            'type' => 'edu'
        ]);

        $sicence = Field::create([
            'name' => 'Science',
            'slug' => 'science',
            'parent_id' => null,
            'type' => 'edu'
        ]);

         Field::create([
            'name' => 'Electrical Engineering',
            'slug' => 'electrical-engineering',
            'parent_id' => $engineering->id,
            'type' => 'edu'
        ]);

        Field::create([
            'name' => 'Physics',
            'slug' => 'physics',
            'parent_id' => $sicence->id,
            'type' => 'edu'
        ]);

        $trips = Field::create([
            'name' => 'Trips',
            'slug' => 'trips',
            'parent_id' => null,
            'type' => 'entmt'
        ]);

         $sports = Field::create([
            'name' => 'Sports',
            'slug' => 'sports',
            'parent_id' => null,
            'type' => 'entmt'
        ]);

         Field::create([
            'name' => 'Safari Trips',
            'slug' => 'safari-trips',
            'parent_id' => $trips->id,
            'type' => 'entmt'
        ]);

        Field::create([
            'name' => 'Football',
            'slug' => 'football',
            'parent_id' => $sports->id,
            'type' => 'entmt'
        ]);

        Redis::set('eduFields.all', \App\Field::where('parent_id', null)->where('type', 'edu')->get()->toJson());
        Redis::set('entmtFields.all', \App\Field::where('parent_id', null)->where('type', 'entmt')->get()->toJson());

//
//        factory('App\Field', 5)->create(['parent_id' => null, 'type' => 'edu']);
//
//        $mainEduFields = Field::all();
//
//
//        $mainEduFields->each(function($field){
//            factory('App\Field', 5)->create(['parent_id' => $field->id, 'type' => 'edu']);
//        });
//
//        factory('App\Field', 5)->create(['parent_id' => null, 'type' => 'entmt']);
//
//        $mainEntmtFields = Field::where('parent_id', null)->where('type', 'entmt')->get();
//
//        $mainEntmtFields->each(function($field){
//            factory('App\Field', 5)->create(['parent_id' => $field->id, 'type' => 'entmt']);
//        });

    }
}
