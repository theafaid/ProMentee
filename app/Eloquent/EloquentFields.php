<?php


namespace App\Eloquent;

use App\Field;
use App\Libs\Fields;

class EloquentFields implements Fields
{
    /**
     * Fetch main fields from database according to it's type
     * @param $type
     * @return mixed
     */
    public function mainFields($type){
        return Field::where('parent_id', null)->where('type', $type)->get();
    }
}
