<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionFieldValidation extends Model
{
    public function fields(){
        return $this->belongsToMany(QuestionField::class, 'question_field_question_field_validation');
    }
}
