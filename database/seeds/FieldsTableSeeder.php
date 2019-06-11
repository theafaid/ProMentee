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

        $educationFields = [
            'engineering' => [
                'en' => 'Engineering',
                'ar' => 'الهندسة',

                'children' => [
                    [

                        'ar' => 'بيولوجي',
                        'en' => 'Biological'
                    ],

                    [

                        'ar' => 'الهندسة الزراعية',
                        'en' => 'Agricultural Engineering'
                    ],

                    [

                        'ar' => 'الهندسة الطبية الحيوية',
                        'en' => 'Biomedical Engineering'
                    ],

                    [

                        'ar' => 'هندسة كيميائية',
                        'en' => 'Chemical Engineering'
                    ],

                    [

                        'ar' => 'الهندسة المدنية والبيئية',
                        'en' => 'Civil and Environmental Engineering'
                    ],

                    [

                        'ar' => 'هندسة اتصالات',
                        'en' => 'communication engineering'
                    ],

                    [

                        'ar' => 'هندسة القوى والآلات',
                        'en' => 'power and machines engineering'
                    ],

                    [

                        'ar' => 'الهندسة الكهربائية والحاسوب',
                        'en' => 'Electrical and Computer Engineering'
                    ],

                    [

                        'ar' => 'علم و هندسة المواد',
                        'en' => 'Materials Science and Engineering'
                    ],

                    [

                        'ar' => 'هندسة ميكانيكية وفضائية',
                        'en' => 'Mechanical and Aerospace Engineering'
                    ],

                ],
            ],

            'pharmacy' => [
                'ar' => 'الصيدلية',
                'en' => 'Pharmacy',

                'children' => [
                    [

                        'ar' => 'الصيدلة والصيدلة الصناعية',
                        'en' => 'Pharmaceutics & Industrial Pharmacy'
                    ],
                    [

                        'ar' => 'العقاقير',
                        'en' => 'Pharmacognosy'
                    ],
                    [

                        'ar' => 'علم الأدوية والسموم',
                        'en' => 'Pharmacology & Toxicology'
                    ],
                    [

                        'ar' => 'علم الأحياء الدقيقة والمناعة',
                        'en' => 'Microbiology & Immunology'
                    ],
                    [

                        'ar' => 'الكيمياء العضوية الصيدلانية',
                        'en' => 'Pharmaceutical Organic Chemistry'
                    ],
                    [

                        'ar' => 'الكيمياء التحليلية',
                        'en' => 'Analytical Chemistry'
                    ],
                    [

                        'ar' => 'الكيمياء الحيوية',
                        'en' => 'Biochemistry'
                    ],
                    [

                        'ar' => 'الكيمياء الصيدلانية',
                        'en' => 'Pharmaceutical Chemistry'
                    ],
                    [

                        'ar' => 'عيادة صيدلية',
                        'en' => 'Clinical Pharmacy'
                    ],
                ],
            ],

            [
                'ar' => 'الطب',
                'en' => 'Medicine',
                'children' => [
                    [
                        'ar' => 'تشريح',
                        'en' => 'anatomy'
                    ],
                    [

                        'ar' => 'علم الانسجة',
                        'en' => 'histology'
                    ],
                    [

                        'ar' => 'الكيمياء الحيوية',
                        'en' => 'biochemistry'
                    ],
                    [

                        'ar' => 'وظائف الأعضاء',
                        'en' => 'physiology'
                    ],
                ]
            ]
        ];

        $entertainmentFields = [
            'physical_sports' => [
                'en' => 'Physical sports',
                'ar' => 'الرياضة البدنية',
                'children' => [
                    [
                        'en' => 'Football',
                        'ar' => 'كرة القدم',
                    ],
                    [
                        'en' => 'Glof',
                        'ar' => 'الجولف',
                    ]
                ]
            ]
        ];

        foreach($educationFields as $mainField){
            $field = new Field;

            $field->type = 'edu';
            foreach($supportedLocales as $locale){
                if($mainField[$locale]) $field->setTranslation('name', $locale, $mainField[$locale]);
            }
            $field->slug = \Str::slug($mainField['en']);
            $field->save();

            foreach($mainField['children'] as $child){
                $subField = new Field;

                $subField->type = $field->type; // edu
                foreach($supportedLocales as $locale){
                    if($child[$locale]) $subField->setTranslation('name', $locale, $child[$locale]);
                }
                $subField->slug = \Str::slug($child['en']);
                $subField->parent_id = $field->id;
                $subField->save();
            }
        }

        foreach($entertainmentFields as $mainField){
            $field = new Field;

            $field->type = 'entmt';
            foreach($supportedLocales as $locale){
                if($mainField[$locale]) $field->setTranslation('name', $locale, $mainField[$locale]);
            }
            $field->slug = \Str::slug($mainField['en']);
            $field->save();

            foreach($mainField['children'] as $child){
                $subField = new Field;

                $subField->type = $field->type; // entmt
                foreach($supportedLocales as $locale){
                    if($child[$locale]) $subField->setTranslation('name', $locale, $child[$locale]);
                }
                $subField->slug = \Str::slug($child['en']);
                $subField->parent_id = $field->id;
                $subField->save();
            }
        }
    }
}
