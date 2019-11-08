<?php

use Illuminate\Database\Seeder;
use App\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new QuestionType();
        $type->name = "True or False";
        $type->save();

        $type = new QuestionType();
        $type->name = "Yes or No";
        $type->save();

        $type = new QuestionType();
        $type->name = "Text Input";
        $type->save();

        $type = new QuestionType();
        $type->name = "Large Text Input";
        $type->save();

        $type = new QuestionType();
        $type->name = "Multiple Choice";
        $type->save();

        $type = new QuestionType();
        $type->name = "Select One";
        $type->save();

        $type = new QuestionType();
        $type->name = "File Upload";
        $type->save();

        $type = new QuestionType();
        $type->name = "Information";
        $type->save();

    }
}
