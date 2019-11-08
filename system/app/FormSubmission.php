<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    public function getUserIdAttribute($value){
        return User::where('id', $value)->first();
    }
}
