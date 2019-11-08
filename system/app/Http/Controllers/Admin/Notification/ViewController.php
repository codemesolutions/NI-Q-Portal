<?php

namespace App\Http\Controllers\Admin\Notification;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\NotificationTypes;
use App\PageType;
use App\Menu;
use App\User;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Request $request)
    {
        $page = $this->getPage($request);

        $page['datasets']['list'] = [
            'columns' => [
                'Type' => 'notification_type_id',
                'Message' => function($row){
                    return strip_tags($row['message']);
                },
                'Created Date' => 'created_at'
            ],
            'rows' => Notifications::all()
        ];

        $page['view_route'] = "/admin/notifications/notification";
        $page['update_route'] = Route('admin.notification.update');
        $page['create_route'] = Route('admin.notification.create');

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = Notifications::where('id', $id)->first();
       
        
        if(is_null($results)){
            //abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.notification.delete');
        $page['update_route'] = Route('admin.notification.update');
        $page['create_route'] = Route('admin.notification.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.notification.create';
        
        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(NotificationTypes::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => false
            ];
        }

        $page['fields'][] = [
            'name' => 'message',
            'type' => 'textarea',
            'label' => "Message",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('message')
        ];

        $page['fields'][] = [
            'name' => 'resource',
            'type' => 'text',
            'label' => "Resource",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('resource')
        ];

        
        $page['fields']['users'] = [
            'name' => 'users',
            'type' => 'checkbox-select',
            'label' => "Users",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['users']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => false
            ];
        }

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
       
        $menu = Notifications::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.notification.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(NotificationTypes::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => $pageType->name == $menu->notification_type_id ? true:false,
            ];
        }

        $page['fields'][] = [
            'name' => 'message',
            'type' => 'textarea',
            'label' => "Message",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $menu->message
        ];

        $page['fields'][] = [
            'name' => 'resource',
            'type' => 'text',
            'label' => "Resource",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $menu->resource
        ];


        $page['fields']['users'] = [
            'name' => 'user',
            'type' => 'checkbox-select',
            'label' => "Users",
            'helper' => 'The users you want to assign to this permissions',
            'options' => []
        ];

        foreach(User::all() as $user){
            
            if(!is_null($menu->users()->where('users.id', $user->id)->first())){
                $page['fields']['users']['options'][] = [
                    'name' => $user->name,
                    'value' => $user->id,
                    'selected' => true
                ];
            }

            else{
                $page['fields']['users']['options'][] = [
                    'name' => $user->name,
                    'value' => $user->id,
                    'selected' => false,
                    
                ];
            }
           
        }

        return view($page['template'], $page);
    }
}
