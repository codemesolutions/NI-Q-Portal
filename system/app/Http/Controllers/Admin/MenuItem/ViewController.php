<?php

namespace App\Http\Controllers\Admin\MenuItem;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Page;
use App\Permission;
use App\Menu;
use App\MenuItem;

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
                'Path'  => 'path',
                'Created Date' => 'created_at'
            ],

            'rows' => MenuItem::where('menu_id', $request->query('id'))->get()
        ];

        $page['update_route'] = Route('admin.menu-item.update');
        $page['create_route'] = Route('admin.menu-item.create', ['id' => $request->query('id')]);

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = \App\MenuItem::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.menu-item.delete');
        $page['update_route'] = Route('admin.menu-item.update');
        $page['create_route'] = Route('admin.menu-item.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {   
        if(!$request->has('id')){
            return redirect()->back();
        }

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.menu-item.create';

        $page['fields'][] = [
            'name' => 'menu',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];
        
        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu item to be titled',
            'value' => old('name') 
        ];

        $page['fields'][] = [
            'name' => 'path',
            'type' => 'text',
            'label' => "Path",
            'helper' => 'The url you want the menu item to be titled',
            'value' => old('path') 
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

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
        $current = MenuItem::where('id', $request->query('id'))->firstOrFail();

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.menu-item.update';

      
        $page['fields'][] = [
            'name' => 'menu',
            'type' => 'hidden',
            'value' => $current->menu_id->id,
        ];

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $current->id,
        ];

        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu item to be titled',
            'value' =>  $current->name
        ];

        $page['fields'][] = [
            'name' => 'path',
            'type' => 'text',
            'label' => "Path",
            'helper' => 'The url you want the menu item to be titled',
            'value' => $current->path
        ];

        $page['fields']['roles'] = [
            'name' => 'role',
            'type' => 'checkbox-select',
            'label' => "Permissions",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];
        
        foreach(Permission::all() as $perm){
            
            if(!is_null($current->permissions()->where('permissions.id', $perm->id)->first())){
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

        return view($page['template'], $page);
    }
}
