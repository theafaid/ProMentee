<?php


namespace App\Eloquent;

use App\Field;
use App\Libs\Fields;

class EloquentFields implements Fields
{
    public function mainFields($type){
        return Field::where('parent_id', null)->where('type', $type)->get();
    }
}
