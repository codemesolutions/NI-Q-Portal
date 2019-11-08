<?php

use Illuminate\Database\Seeder;
use App\QuestionConditionType;
use App\QuestionConditionAction;

class QuestionConditionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new QuestionConditionType();
        $type->name = "Value Equals";
        $type->save();

        $type = new QuestionConditionType();
        $type->name = "Value Less Than";
        $type->save();

        $type = new QuestionConditionType();
        $type->name = "Value Greater Than";
        $type->save();



        $type = new QuestionConditionAction();
        $type->name = "Disqualify";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 14 days";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 30 days";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 60 days";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 90 days";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 6 months";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 9 months";
        $type->save();

        $type = new QuestionConditionAction();
        $type->name = "Wait 1 Year";
        $type->save();
    }
}
