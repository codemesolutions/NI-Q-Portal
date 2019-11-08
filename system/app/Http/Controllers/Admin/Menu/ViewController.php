<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Menu;

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
            'rows' => Menu::all()
        ];

        $page['view_route'] = Route('admin.menu');
        $page['update_route'] = Route('admin.menu.update');
        $page['create_route'] = Route('admin.menu.create');

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = Menu::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = Route('admin.menu');
        $page['delete_route'] = Route('admin.menu.delete');
        $page['update_route'] = Route('admin.menu.update');
        $page['create_route'] = Route('admin.menu.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.menu.create';
        
        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('name')
        ];

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
       
        $menu = Menu::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.menu.update';

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
            'value' => $menu->name
        ];

        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => $menu->active,
        ];

        return view($page['template'], $page);
    }
}
