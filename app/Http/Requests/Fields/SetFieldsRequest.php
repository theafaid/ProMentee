<?php

namespace App\Http\Requests\Fields;

use App\Field;
use App\Rules\ValidField;
use Illuminate\Foundation\Http\FormRequest;

class SetFieldsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'eduFields'  => 'required|array|min:1|max:3',
            'eduFields.*' =>['numeric', new ValidField('edu') ],
            'entmtFields' => 'required|array|min:1',
            'entmtFields.*' =>['numeric', new ValidField('entmt')]
        ];

    }

    public function save(){

        if(! $this->user()->hasSetFields()){

            // set selected fields to authenticated user
            collect(array_merge($this->eduFields, $this->entmtFields))->map(function($id){
                $this->user()->setField(Field::find($id));
            });

            return response(['msg' => __('javascript.set_fields_done')], 200);
        }

        // user has set his fields before
        return response(['msg' => 'something_went_wrong'], 422);
    }
}
