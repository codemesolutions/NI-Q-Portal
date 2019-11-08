<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Permission;
use App\Notifications;
use App\Form;
use App\FormType;
use App\Page;
use App\PageType;
use App\NotificationTypes;
use App\Document;
use App\Message;
use App\Menu;
use App\Donor;
use App\DonorRequest;
use App\FormSubmission;
use App\Setting;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPage(Request $request){
        
        
        $savedPage = Page::where('slug', $request->path())->where('active', true)->first();
       
        
        if(is_null($savedPage)){
            abort(404);
        }

        $perms = $savedPage->permissions()->get();
        $accessGranted = false;

        if($perms->count() > 0 && is_null($request->user())){
           
            abort(403);
        }
        
        else if($perms->count() > 0 && !is_null($request->user())){
            
            foreach($request->user()->permissions()->get() as $role){
                foreach($perms as $permission){
                    if($role->id === $permission->id){
                        $accessGranted = true;
                    }
                }
            }

            // if they do not have permissions attached they are a prospect.
            if(!$accessGranted){
                $submission = FormSubmission::where('user_id', $request->user()->id)->first();

                if(is_null($submission)){
                    return Setting::where('name', 'Register Redirect')->first()->value;
                }

                else{
                    return Setting::where('name', 'Register Redirect')->first()->value;
                }
            }
        }

        else{
            $accessGranted = true;
        }

        if(!$accessGranted){
            abort(403);
        }

        $page = [];
        $page['page'] = $savedPage;
        
        if(!is_null($savedPage)){
            $page['type'] = $savedPage->page_type_id;
        }
       
        $page['request'] = $request;
        
        $page['title'] = $savedPage->title;
        $page['slug'] = $savedPage->slug;
        $page['template'] = $savedPage->template;
        $page['content'] = $savedPage->content;
        $page['hideSidebar'] = false;
        $page['donors'] = Donor::all();
        $page['users'] = User::all();
        $page['notifications'] = Notifications::all();
        $page['latest_notifications'] = Notifications::orderBy('created_at', 'desc')->take(10)->get();
        $page['forms'] = Form::all();
        $page['types'] = FormType::all();
        $page['roles'] = Permission::all();
        //$page['requests'] = DonorRequest::all();
        $page['pages'] = Page::all();
        $page['documents'] = Document::all();
        
        $page['menus'] = Menu::all();
        $page['fields'] = [];
        $page['datasets'] = [];
       
        $page['admin_menu'] = Menu::where('name', 'Admin Menu')->first();
        $page['site_menu'] = Menu::where('name', 'Site Menu')->first();
        $page['donor_menu'] = Menu::where('name', 'Donor Menu')->first();

        if(!is_null($request->user())){
            $page['userPermissions'] = $request->user()->permissions()->get();
        }
      
       
        $page['pageTypes'] = PageType::all();
        $page['notificationTypes'] = NotificationTypes::all();
       
    

        return $page;
    }
}
