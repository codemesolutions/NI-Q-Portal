<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Fields implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        
        if(!is_array($value)){
            return false;
        }

        if(!isset($value['name'])){
            return false;
        }

        elseif(is_null($value['name']) || $value['name'] == ''){
            return false;
        }

        else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field name is required';
    }
}
