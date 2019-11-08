<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionField extends Model
{
    public function validations(){
        return $this->belongsToMany(QuestionFieldValidation::class, 'question_field_question_field_validation')->withPivot('value');
    }

    public function conditions(){
        return $this->hasMany(QuestionCondition::class, 'field_id');
    }

    public function getQuestionFieldTypeIdAttribute($value)
    {
        return QuestionFieldType::where('id', $value)->first();
    }


}
