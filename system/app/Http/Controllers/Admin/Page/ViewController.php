<?php

namespace App\Http\Controllers\Admin\Page;

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
                'Title' => 'title',
                'Type'  => 'page_type_id',
                'Slug'  => 'slug',
                'Status' => 'active',
                'Created Date' => 'created_at'
            ],
            'rows' => Page::all()
        ];

        $page['view_route'] = Route('admin.page');
        $page['update_route'] = Route('admin.page.update');
        $page['create_route'] = Route('admin.page.create');

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = Page::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.page.delete');
        $page['update_route'] = Route('admin.page.update');
        $page['create_route'] = Route('admin.page.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.page.create';

       
        
        $page['fields'][] = [
            'name' => 'title',
            'type' => 'text',
            'label' => "Title",
            'helper' => 'The name you want the page to be titled',
            'value' => old('title') 
        ];

        $page['fields'][] = [
            'name' => 'slug',
            'type' => 'text',
            'label' => "Slug",
            'helper' => 'The url you want the page to be found under',
            'value' => old('slug') 
        ];

       
        
        $page['fields'][] = [
            'name' => 'content',
            'type' => 'richtext',
            'label' => "Content",
            'helper' => 'Your page content goes here',
            'value' => old('content') 
        ];

        $page['fields'][] = [
            'name' => 'meta_description',
            'type' => 'textarea',
            'label' => "Description",
            'helper' => 'The page description to be indexed by search engines',
            'value' => old('meta_description') 
        ];

        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(PageType::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => false
            ];
        }

        $page['fields']['templates'] = [
            'name' => 'template',
            'type' => 'select',
            'label' => "Templates",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(Page::getTemplates(config('view.paths')[0]) as $template){
            $page['fields']['templates']['options'][] = [
                'name' => $template,
                'value' => $template,
                'selected' => $template === 'page' ? true:false
            ];
        }

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
            'checked' => false
        ];

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
        $current = Page::where('id', $request->query('id'))->firstOrFail();

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.page.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $current->id,
        ];

        $page['fields'][] = [
            'name' => 'title',
            'type' => 'text',
            'label' => "Title",
            'helper' => 'The name you want the page to be titled',
            'value' => $current->title,
        ];

        $page['fields'][] = [
            'name' => 'slug',
            'type' => 'text',
            'label' => "Slug",
            'helper' => 'The url you want the page to be found under',
            'value' => $current->slug,
        ];

        $page['fields'][] = [
            'name' => 'content',
            'type' => 'richtext',
            'label' => "Content",
            'helper' => 'Your page content goes here',
            'value' => $current->content,
        ];


        $page['fields'][] = [
            'name' => 'meta_description',
            'type' => 'textarea',
            'label' => "Description",
            'helper' => 'The page description to be indexed by search engines',
            'value' => $current->meta_description,
        ];

        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(PageType::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => $pageType->id == $current->page_type_id ? true:false
            ];
        }

        $page['fields']['templates'] = [
            'name' => 'template',
            'type' => 'select',
            'label' => "Templates",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(Page::getTemplates(config('view.paths')[0]) as $template){
          
            $page['fields']['templates']['options'][] = [
                'name' => $template,
                'value' => $template,
                'selected' =>  $template == $current->template ? true:false
            ];
        }

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

        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => $current->active == 'Active' ? true:false
        ];

        return view($page['template'], $page);
    }
}
