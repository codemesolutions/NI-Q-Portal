<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Permission;
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
                'Name' => 'name',
                'Status' => 'active',
                'Created Date' => 'created_at'
            ],
            'rows' => Permission::all()
        ];

        $page['view_route'] = Route('admin.permission');
        $page['update_route'] = Route('admin.permission.update');
        $page['create_route'] = Route('admin.permission.create');

        return view($page['template'], $page);
    }


    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = Permission::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.permission.delete');
        $page['update_route'] = Route('admin.permission.update');
        $page['create_route'] = Route('admin.permission.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.permission.create';
        
        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('name')
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

        
        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => false,
        ];

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
       
        $permmission = Permission::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.permission.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $permmission->name
        ];


        $page['fields']['users'] = [
            'name' => 'user',
            'type' => 'checkbox-select',
            'label' => "Users",
            'helper' => 'The users you want to assign to this permissions',
            'options' => []
        ];

        foreach(User::all() as $user){
            
            if(!is_null($permmission->users()->where('users.id', $user->id)->first())){
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

        
        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => $permmission->active,
        ];


        return view($page['template'], $page);
    }
}
