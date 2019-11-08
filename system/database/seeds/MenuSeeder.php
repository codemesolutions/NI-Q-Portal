<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\MenuItem;
use App\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name = 'Admin Menu';
        $menu->active = true;
        $menu->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Dashboard";
        $menuItem->path = 'admin';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Donors";
        $menuItem->path = 'admin/donors';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Messages";
        $menuItem->path = 'admin/message';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Notifications";
        $menuItem->path = 'admin/notifications';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        /*
        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Documents";
        $menuItem->path = 'admin/documents';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first()); */

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Shipping/Recieving";
        $menuItem->path = 'admin/shipping';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'manager')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Forms";
        $menuItem->path = 'admin/forms';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());


        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Users";
        $menuItem->path = 'admin/users';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Permissions";
        $menuItem->path = 'admin/permissions';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Pages";
        $menuItem->path = 'admin/pages';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Menu";
        $menuItem->path = 'admin/menus';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Settings";
        $menuItem->path = 'admin/settings';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());

        

       

       
        $menu = new Menu();
        $menu->name = 'Donor Menu';
        $menu->active = true;
        $menu->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Home";
        $menuItem->path = '/';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'donor')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'manager')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Messages";
        $menuItem->path = '/messages';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'donor')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'manager')->first());

       

        

        /*
        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Documents";
        $menuItem->path = '/documents';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'donor')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first()); */



        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Account";
        $menuItem->path = '/account';
        $menuItem->save();
        $menuItem->permissions()->attach(Permission::where('name', 'donor')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'manager')->first());

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Administration";
        $menuItem->path = '/admin';
        $menuItem->save();
 
        $menuItem->permissions()->attach(Permission::where('name', 'admin')->first());
        $menuItem->permissions()->attach(Permission::where('name', 'manager')->first());

        $menu = new Menu();
        $menu->name = 'Site Menu';
        $menu->active = true;
        $menu->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Home";
        $menuItem->path = 'https://www.ni-q.com/';
        $menuItem->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "About Us";
        $menuItem->path = 'https://www.ni-q.com/about-us/';
        $menuItem->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "The Science";
        $menuItem->path = 'https://www.ni-q.com/science/';
        $menuItem->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Schedule a meeting";
        $menuItem->path = 'https://www.ni-q.com/appointments/';
        $menuItem->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Professional";
        $menuItem->path = 'https://www.ni-q.com/professional/';
        $menuItem->save();

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->name = "Contact Us";
        $menuItem->path = 'https://www.ni-q.com/contact/';
        $menuItem->save();

    }

}
