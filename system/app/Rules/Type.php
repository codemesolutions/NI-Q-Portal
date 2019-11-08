<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Type implements Rule
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
            dd("no array");
            return false;
        }

        if(!isset($value['type'])){
            dd("no type");
            return false;
        }

        elseif(is_null($value['type']) || $value['type'] == ''){
            dd("no type null");
            return false;
        }

        elseif($value['type'] === 2 ){
            dd("radio type no label");
            return false;
        }


        elseif($value['type'] == 3){
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
        return 'The :attribute field type requires a Label and Value';
    }
}
