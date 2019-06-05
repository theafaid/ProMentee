<?php

namespace App\Rules;

use App\Field;
use Illuminate\Contracts\Validation\Rule;

class ValidField implements Rule
{
    protected $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $statement = Field::where('id', $value)->where('type', $this->type)->where('parent_id' , '!=', null);

        return $statement->first() ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('site.invalid_field_inserted');
    }
}
