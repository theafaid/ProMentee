<?php

namespace App\Http\Requests;

use App\Field;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:45',
            'body' => 'required|string|min:20|max:10000',
            'type' => 'required|string|in:advice,information,request,idea,other',
            'field_id' => 'required|numeric|exists:fields,id|in:'.implode(',', resolve('User')->fieldsIds())
        ];
    }
    public function store(){
         Field::find($this->field_id)
            ->newPost($this->only(['title', 'body', 'type']));
    }
}
