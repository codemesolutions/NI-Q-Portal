<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCondition extends Model
{
    public function actions(){
        return $this->belongsTo(QuestionConditionAction::class, 'question_condition_action_id');
    }
}
