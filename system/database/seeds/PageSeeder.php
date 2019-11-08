<?php

use Illuminate\Database\Seeder;
use App\PageType;
use App\Page;
use App\Permission;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DASHBOARD
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Dashboard";
        $page->slug = 'admin';
        $page->template = 'admin.dashboard';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);



        //FORMS
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Forms";
        $page->slug = 'admin/forms';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Forms";
        $page->slug = 'admin/forms/form';
        $page->template = 'admin.form-single';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Form";
        $page->slug = 'admin/form/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Form";
        $page->slug = 'admin/form/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Form Submissions";
        $page->slug = 'admin/forms/submissions';
        $page->template = 'admin.submission-list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Form Submission";
        $page->slug = 'admin/forms/submissions/submission';
        $page->template = 'admin.submission';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Forms Create";
        $page->slug = 'admin/forms/create';
        $page->template = 'admin.forms.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        //END FORMS



        //DONORS
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Donors";
        $page->slug = 'admin/donors';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Donors";
        $page->slug = 'admin/donors/donor';
        $page->template = 'admin.donor';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Donor";
        $page->slug = 'admin/donors/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Donor";
        $page->slug = 'admin/donors/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        //END DONOR


       

         //USER
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Users";
         $page->slug = 'admin/users';
         $page->template = 'admin.list';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "User";
         $page->slug = 'admin/users/user';
         $page->template = 'admin.user-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Create User";
         $page->slug = 'admin/user/create';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Update User";
         $page->slug = 'admin/user/update';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         //END USER


         //Notifications
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Notifications";
         $page->slug = 'admin/notifications';
         $page->template = 'admin.list';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Notification";
         $page->slug = 'admin/notifications/notification';
         $page->template = 'admin.notifications-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Create Notification";
         $page->slug = 'admin/notification/create';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Update Notification";
         $page->slug = 'admin/notification/update';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         //END NOTFICATIONS




        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Shipping/Recieving";
        $page->slug = 'admin/shipping';
        $page->template = 'admin.shipping-list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);


        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Shipping Request";
        $page->slug = 'admin/shipping/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Shipping Export";
        $page->slug = 'admin/shipping/export';
        $page->template = 'admin.export';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);





        //NOTIFICATIONS
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Donors";
        $page->slug = 'admin/donors';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Donor";
        $page->slug = 'admin/donors/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Donor";
        $page->slug = 'admin/donors/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        //END NOTFICATIONS





        //PAGES
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Pages";
        $page->slug = 'admin/pages';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Page";
         $page->slug = 'admin/pages/page';
         $page->template = 'admin.page-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Page";
        $page->slug = 'admin/page/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Page";
        $page->slug = 'admin/page/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);




        //MENU
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Menus";
        $page->slug = 'admin/menus';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Menu";
         $page->slug = 'admin/menus/menu';
         $page->template = 'admin.menu-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Menu";
        $page->slug = 'admin/menu/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Menu";
        $page->slug = 'admin/menu/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        //END MENU


        //MENU ITEMS
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Menu Items";
        $page->slug = 'admin/menu-items';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Menu Item";
         $page->slug = 'admin/menu-items/menu-item';
         $page->template = 'admin.menu-item-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Menu Item";
        $page->slug = 'admin/menu-item/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Menu Item";
        $page->slug = 'admin/menu-item/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        //END MENU ITEMS




         //PERMISSIONS
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Permissions";
         $page->slug = 'admin/permissions';
         $page->template = 'admin.list';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Permission";
         $page->slug = 'admin/permissions/permission';
         $page->template = 'admin.permission-single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Create Permission";
         $page->slug = 'admin/permission/create';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Update Permission";
         $page->slug = 'admin/permission/update';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         //END PEMRISSIONS



        //MESSAGES
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Messages";
         $page->slug = 'admin/message';
         $page->template = 'admin.message-list';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Create Message";
         $page->slug = 'admin/message/create';
         $page->template = 'admin.message-create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
 
         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Update Message";
         $page->slug = 'admin/message/update';
         $page->template = 'admin.create';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Message";
        $page->slug = 'admin/message/view';
        $page->template = 'admin.message';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);



 
         //END MESSAGES

         $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Settings";
         $page->slug = 'admin/settings';
         $page->template = 'admin.settings';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);



        //QUESTIONS
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Form Questions";
        $page->slug = 'admin/forms/questions';
        $page->template = 'admin.list';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
         $page->page_type_id = PageType::where('name', 'admin')->first()->id;
         $page->title = "Question";
         $page->slug = 'admin/forms/questions/question';
         $page->template = 'admin.single';
         $page->active = true;
         $page->save();
         $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Form Question";
        $page->slug = 'admin/forms/questions/create';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Update Form Question";
        $page->slug = 'admin/forms/questions/update';
        $page->template = 'admin.create';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);

    
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'admin')->first()->id;
        $page->title = "Create Form Question Map";
        $page->slug = 'admin/forms/questions/map';
        $page->template = 'admin.map';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);














        //SITE PAGES
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Dashboard";
        $page->slug = '/';
        $page->template = 'site.boxed';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Messages";
        $page->slug = 'messages';
        $page->template = 'site.messages.messages';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Messages";
        $page->slug = 'messages/message';
        $page->template = 'site.messages.message';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Forms";
        $page->slug = 'forms';
        $page->template = 'site.forms';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Form";
        $page->slug = 'donor/form';
        $page->template = 'site.donor-form';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Milk Kits";
        $page->slug = 'milkkits';
        $page->template = 'site.milkkits';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Blood Kits";
        $page->slug = 'bloodkits';
        $page->template = 'site.bloodkits';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Documents";
        $page->slug = 'documents';
        $page->template = 'site.documents';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Account";
        $page->slug = 'account';
        $page->template = 'site.account';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'Shipping')->first()->id);

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'donor')->first()->id;
        $page->title = "Donor Payments";
        $page->slug = 'payments';
        $page->template = 'site.payments';
        $page->active = true;
        $page->save();
        $page->permissions()->attach(Permission::where('name', 'admin')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'donor')->first()->id);
        $page->permissions()->attach(Permission::where('name', 'manager')->first()->id);

        
        $page = new Page();
        $page->page_type_id = PageType::where('name', 'public')->first()->id;
        $page->title = "Form";
        $page->slug = 'form';
        $page->template = 'site.form';
        $page->active = true;
        $page->save();

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'public')->first()->id;
        $page->title = "Thank you";
        $page->slug = 'form/thankyou';
        $page->template = 'site.thankyou';
        $page->active = true;
        $page->save();

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'public')->first()->id;
        $page->title = "Disqualified";
        $page->slug = 'form/disqualified';
        $page->template = 'site.disqualify';
        $page->active = true;
        $page->save();

        $page = new Page();
        $page->page_type_id = PageType::where('name', 'public')->first()->id;
        $page->title = "Waitlisted";
        $page->slug = 'form/waitlisted';
        $page->template = 'site.waitlisted';
        $page->active = true;
        $page->save();
        

    }
}
