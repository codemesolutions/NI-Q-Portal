<?php

use Illuminate\Database\Seeder;
use App\FormType;

class FormTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formType = new FormType();
        $formType->name = "public";
        $formType->active = true;
        $formType->save();

        $formType = new FormType();
        $formType->name = "donor";
        $formType->active = true;
        $formType->save();

        $formType = new FormType();
        $formType->name = "admin";
        $formType->active = true;
        $formType->save();

        $formType = new FormType();
        $formType->name = "Lab";
        $formType->active = true;
        $formType->save();
    }
}
