<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(FormTypeTableSeeder::class);
         $this->call(ValidationTableSeeder::class);
         $this->call(NoticationTypeSeeder::class);
         $this->call(PageTypeSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(QuestionTypeSeeder::class);
         $this->call(QuestionConditionTypeSeeder::class);
         $this->call(QuestionFieldTypeSeeder::class);
         $this->call(QuestionFieldValidationSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(FormTableSeeder::class);
    }
}
