<?php


namespace App\Eloquent;

use App\Field;

class EloquentFields
{
    public function mainEduFields(){
        return Field::where('parent_id', null)->where('type', 'edu')->get();
    }

    public function mainEntmtFields(){
        return Field::where('parent_id', null)->where('type', 'entmt')->get();
    }
}
