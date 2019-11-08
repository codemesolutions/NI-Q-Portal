<?php

use Illuminate\Database\Seeder;
use App\NotificationTypes;

class NoticationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nt = new NotificationTypes();
        $nt->name = "Form Submission";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "Message";
        $nt->save();

       
        $nt = new NotificationTypes();
        $nt->name = "Request Recieved";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "Page Created";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "Form Created";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "Form Assigned";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "User Created";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "Donor Approved";
        $nt->save();

        $nt = new NotificationTypes();
        $nt->name = "permission created";
        $nt->save();
    }
}
