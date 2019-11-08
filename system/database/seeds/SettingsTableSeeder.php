<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->name = "Register Redirect";
        $setting->value = "/form?name=Donor Application";
        $setting->type = "text";
        $setting->save();

        $setting = new Setting();
        $setting->name = "Disqualified Donor Title";
        $setting->value = "You have been disqualified";
        $setting->type = "text";
        $setting->save();

        $setting = new Setting();
        $setting->name = "Disqualified Donor Message";
        $setting->value = "You have been disqualified";
        $setting->type = "textarea";
        $setting->save();

        $setting = new Setting();
        $setting->name = "Completed Donor Title";
        $setting->value = "You have been disqualified";
        $setting->type = "text";
        $setting->save();

        $setting = new Setting();
        $setting->name = "Completed Donor Message";
        $setting->value = "You have been disqualified";
        $setting->type = "textarea";
        $setting->save();


        $setting = new Setting();
        $setting->name = "Wait Listed Donor Title";
        $setting->value = "You have been waitlisted";
        $setting->type = "text";
        $setting->save();

        $setting = new Setting();
        $setting->name = "Wait Listed Donor Message";
        $setting->value = "You have been waitlisted";
        $setting->type = "textarea";
        $setting->save();

    }
}
