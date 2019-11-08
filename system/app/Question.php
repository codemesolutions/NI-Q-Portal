<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function fields(){
        return $this->hasMany(QuestionField::class);
    }

    public function getFormIdAttribute($value){
        return Form::where('id', $value)->first();
    }
}
