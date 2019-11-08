<?php

use Illuminate\Database\Seeder;
use App\ValidationRule;

class ValidationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $val = new ValidationRule();
        $val->name = "required";
        $val->rule = "required";
        $val->save();

        $val = new ValidationRule();
        $val->name = "letters only";
        $val->rule = "alhpa";
        $val->save();

        $val = new ValidationRule();
        $val->name = "letters & dashes & underscores only";
        $val->rule = "alhpa_dash";
        $val->save();

        $val = new ValidationRule();
        $val->name = "letters & numbers only";
        $val->rule = "alhpa_num";
        $val->save();

        $val = new ValidationRule();
        $val->name = "true/false";
        $val->rule = "boolean";
        $val->save();

        $val = new ValidationRule();
        $val->name = "date";
        $val->rule = "date";
        $val->save();

        $val = new ValidationRule();
        $val->name = "email";
        $val->rule = "email";
        $val->save();

        $val = new ValidationRule();
        $val->name = "file";
        $val->rule = "file";
        $val->save();

        $val = new ValidationRule();
        $val->name = "must contain something";
        $val->rule = "filled";
        $val->save();

        $val = new ValidationRule();
        $val->name = "must contain something";
        $val->rule = "image";
        $val->save();

        $val = new ValidationRule();
        $val->name = "integer";
        $val->rule = "integer";
        $val->save();

        $val = new ValidationRule();
        $val->name = "numeric";
        $val->rule = "numeric";
        $val->save();

        $val = new ValidationRule();
        $val->name = "string";
        $val->rule = "string";
        $val->save();

        $val = new ValidationRule();
        $val->name = "confirmed";
        $val->rule = "confirmed";
        $val->save();
    }
}
