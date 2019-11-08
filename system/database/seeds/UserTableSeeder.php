<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm = new Permission();
        $perm->name = "admin";
        $perm->save();

        $perm = new Permission();
        $perm->name = "donor";
        $perm->save();

        $perm = new Permission();
        $perm->name = "manager";
        $perm->save();

        $user = new User();
        $user->name = "jgetner";
        $user->first_name = 'Joshua';
        $user->last_name = "Getner";
        $user->email = 'jgetner@gmail.com';
        $user->password = bcrypt('eclipse1');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'admin')->first());


        $user = new User();
        $user->name = "bo";
        $user->first_name = 'bo';
        $user->last_name = "jackson";
        $user->email = 'bo@jackson.com';
        $user->password = bcrypt('123');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'donor')->first());

        $user = new User();
        $user->name = "Erica";
        $user->first_name = 'Erica';
        $user->last_name = "";
        $user->email = 'erica@ni-q.com';
        $user->password = bcrypt('B!@ke1C@den2');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'admin')->first());

        $user = new User();
        $user->name = "Peter";
        $user->first_name = 'Peter';
        $user->last_name = "";
        $user->email = 'peter@ni-q.com';
        $user->password = bcrypt('Lacrosse#33');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'admin')->first());

        $user = new User();
        $user->name = "Tara";
        $user->first_name = 'Tara';
        $user->last_name = "";
        $user->email = 'tara@ni-q.com';
        $user->password = bcrypt('Ellaroo20!');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'admin')->first());


        $user = new User();
        $user->name = "Victoria";
        $user->first_name = 'Victoria';
        $user->last_name = "";
        $user->email = 'victoria@ni-q.com';
        $user->password = bcrypt('V!ctori@1120');
        $user->save();
        $user->permissions()->attach(Permission::where('name', 'admin')->first());

    }
}
