<?php

use Illuminate\Database\Seeder;
use App\QuestionFieldValidation;

class QuestionFieldValidationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qfv = new QuestionFieldValidation();
        $qfv->name = 'required';
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "string";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "email";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "numeric";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "date";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "file";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "min";
        $qfv->save();

        $qfv = new QuestionFieldValidation();
        $qfv->name = "max";
        $qfv->save();

        
    }
}
