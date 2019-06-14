<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FieldResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'edu' => $this->getFields('edu'),
                'entmt' => $this->getFields('entmt')
            ]
        ];
//        return parent::toArray($request);
    }

    protected function getFields($type){
        return collect($this[$type])->map(function($field){
            return [
                'id'   => $field['id'],
                'name' => $field['name'],
                'children' => $field['children']
            ];
        });
    }
}
