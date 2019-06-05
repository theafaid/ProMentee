<?php

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
        factory('App\Field', 5)->create(['parent_id' => null, 'type' => 'edu']);

        $mainEduFields = Field::all();

        $mainEduFields->each(function($field){
            factory('App\Field', 5)->create(['parent_id' => $field->id, 'type' => 'edu']);
        });

        factory('App\Field', 5)->create(['parent_id' => null, 'type' => 'entmt']);

        $mainEntmtFields = Field::where('parent_id', null)->where('type', 'entmt')->get();

        $mainEntmtFields->each(function($field){
            factory('App\Field', 5)->create(['parent_id' => $field->id, 'type' => 'entmt']);
        });

    }
}
