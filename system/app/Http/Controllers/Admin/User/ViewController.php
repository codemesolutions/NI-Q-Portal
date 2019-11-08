<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\User;
use App\Permission;

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
                'Username' => 'name',
                'First Name' => 'first_name',
                'Last Name' => 'last_name',
                'Username' => 'name',
                'Email' => 'email',
                'Created Date' => 'created_at'
            ],
            'rows' => User::all()
        ];

        $page['view_route'] = Route('admin.user');
        $page['update_route'] = Route('admin.user.update');
        $page['create_route'] = Route('admin.user.create');

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = User::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.user.delete');
        $page['update_route'] = Route('admin.user.update');
        $page['create_route'] = Route('admin.user.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.user.create';
        
        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "User Name",
            'helper' => 'The user name of the user your want to assign to the user',
            'value' => old('name')
        ];

        $page['fields'][] = [
            'name' => 'first_name',
            'type' => 'text',
            'label' => "First Name",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => old('first_name')
        ];

        $page['fields'][] = [
            'name' => 'last_name',
            'type' => 'text',
            'label' => "Last Name",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => old('last_name')
        ];

        $page['fields'][] = [
            'name' => 'email',
            'type' => 'text',
            'label' => "Email",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => old('email')
        ];

        $page['fields'][] = [
            'name' => 'password',
            'type' => 'password',
            'label' => "Password",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => old('password')
        ];

        $page['fields'][] = [
            'name' => 'password_confirmation',
            'type' => 'password',
            'label' => "Confirm Password",
            'helper' => 'Please re-enter the password to confirm password',
            'value' => ''
        ];

        $page['fields']['roles'] = [
            'name' => 'role',
            'type' => 'checkbox-select',
            'label' => "Permissions",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(Permission::all() as $perm){
            $page['fields']['roles']['options'][] = [
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
       
        $user = User::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.user.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The user name of the user your want to assign to the user',
            'value' => $user->name
        ];

        $page['fields'][] = [
            'name' => 'first_name',
            'type' => 'text',
            'label' => "First Name",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => $user->first_name
        ];

        $page['fields'][] = [
            'name' => 'last_name',
            'type' => 'text',
            'label' => "Last Name",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => $user->last_name
        ];

        $page['fields'][] = [
            'name' => 'email',
            'type' => 'text',
            'label' => "Email",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => $user->email
        ];

        $page['fields'][] = [
            'name' => 'password',
            'type' => 'password',
            'label' => "Password",
            'helper' => 'The email of the user which is used when logging into the system',
            'value' => ''
        ];

        $page['fields'][] = [
            'name' => 'password_confirmation',
            'type' => 'password',
            'label' => "Confirm Password",
            'helper' => 'Please re-enter the password to confirm password',
            'value' => ''
        ];

        $page['fields']['roles'] = [
            'name' => 'role',
            'type' => 'checkbox-select',
            'label' => "Permissions",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(Permission::all() as $perm){
            
            if(!is_null($user->permissions()->where('permissions.id', $perm->id)->first())){
                $page['fields']['roles']['options'][] = [
                    'name' => $perm->name,
                    'value' => $perm->id,
                    'selected' => true
                ];
            }

            else{
                $page['fields']['roles']['options'][] = [
                    'name' => $perm->name,
                    'value' => $perm->id,
                    'selected' => false,
                    
                ];
            }
           
        }

        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => $user->active,
        ];

        return view($page['template'], $page);
    }
}
