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
        $supportedLocales = array_keys(
            \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales()
        );

        $mainFields = [
            'edu'   => ['Engineering', 'Science'],
            'entmt' => ['Trips']
        ];

        $subFields  = [
            'edu' => ['Electrical Engineering', 'Physics'],
            'entmt' => ['Safari trips']
        ];


        foreach ($mainFields['edu'] as $key => $mainEduField){
            $mainField = new Field;

            foreach ($supportedLocales as $locale){
                $value = "{$mainEduField}";

                $mainField->setTranslation('name', $locale, $value . "_" . $locale);
            }
            $mainField->slug = \Str::slug($mainEduField);
            $mainField->slug = \Str::slug($mainEduField);

            $mainField->type = 'edu';
            $mainField->save();

            foreach($subFields['edu'] as $subEduField){
                $subfield = new Field;

                foreach ($supportedLocales as $locale){
                    $value = "{$subEduField}";

                    $subfield->setTranslation('name', $locale, $value . "_" . $locale);
                }
                $subfield->slug = \Str::slug($subEduField);
                $subfield->slug = \Str::slug($subEduField);
                $subfield->parent_id = $mainField->id;
                $subfield->type = 'edu';
                $subfield->save();
            }
        }

        foreach ($mainFields['entmt'] as $key => $mainEntmtField){
            $mainField = new Field;

            foreach ($supportedLocales as $locale){
                $value = "{$mainEntmtField}";

                $mainField->setTranslation('name', $locale, $value . "_" . $locale);
            }
            $mainField->slug = \Str::slug($mainEntmtField);
            $mainField->slug = \Str::slug($mainEntmtField);

            $mainField->type = 'entmt';
            $mainField->save();

            foreach($subFields['entmt'] as $subEduField){
                $subfield = new Field;

                foreach ($supportedLocales as $locale){
                    $value = "{$subEduField}";

                    $subfield->setTranslation('name', $locale, $value . "_" . $locale);
                }
                $subfield->slug = \Str::slug($subEduField);
                $subfield->slug = \Str::slug($subEduField);
                $subfield->parent_id = $mainField->id;
                $subfield->type = 'entmt';
                $subfield->save();
            }
        }


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
