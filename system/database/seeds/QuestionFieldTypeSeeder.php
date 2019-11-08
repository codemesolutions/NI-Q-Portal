<?php

use Illuminate\Database\Seeder;
use App\QuestionFieldType;

class QuestionFieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qft = new QuestionFieldType();
        $qft->name = "text";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "radio";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "checkbox";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "textarea";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "select";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "file upload";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "file download";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "link";
        $qft->save();

        $qft = new QuestionFieldType();
        $qft->name = "password";
        $qft->save();

    }
}
