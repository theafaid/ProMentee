<?php


namespace App\Eloquent;

use App\Field;
use App\Libs\Fields;

class EloquentFields implements Fields
{
    /**
     * Fetch allj main fields from database grouped by it's type
     * @param $type
     * @return mixed
     */
    public function mainFields(){
        return Field::where('parent_id', null)->get()->groupBy(function ($field){
            return $field->type;
        });
    }
}
