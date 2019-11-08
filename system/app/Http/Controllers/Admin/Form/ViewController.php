<?php

namespace App\Http\Controllers\Admin\Form;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\FormType;
use App\Notifications;
use App\PageType;
use App\Menu;
use App\Donor;
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
                'Form Type' => 'form_type_id',
                'Status' => 'active',
                'Created Date' => 'created_at'
            ],
            'rows' => Form::where('form_type_id', '!=', 4)->get()
        ];

        $page['list_actions'] = '/list-table-actions-form';
        $page['questions_route'] =Route('admin.forms.questions');
        $page['submissions_route'] =Route('admin.forms.submissions');
        $page['update_route'] = Route('admin.form.update');
        $page['delete_route'] = Route('admin.form.delete');
        $page['create_route'] = Route('admin.form.create');
        $page['view_route'] = Route('admin.form');

        return view($page['template'], $page);
    }


    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

       
        $results = Form::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        $page['view_route'] = "";
        $page['delete_route'] = Route('admin.form.delete');
        $page['update_route'] = Route('admin.form.update');
        $page['create_route'] = Route('admin.form.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.form.create';
        
        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('name')
        ];

    
        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(FormType::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => false
            ];
        }

        $page['fields']['users'] = [
            'name' => 'users',
            'type' => 'checkbox-select',
            'label' => "Assign To Users",
            'helper' => 'The users you want to assign this form to',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['users']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => false
            ];
        }


        $page['fields']['notify'] = [
            'name' => 'notify',
            'type' => 'checkbox-select',
            'label' => "Notify On Complete",
            'helper' => 'The users you want notified when the form has been completed',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['notify']['options'][] = [
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
       
        $menu = Form::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.form.update';

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
            'name' => 'description',
            'type' => 'textarea',
            'label' => "Description",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $menu->description
        ];

        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(FormType::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => $pageType->name === $menu->form_type_id ? true:false
            ];
        }

        $page['fields']['users'] = [
            'name' => 'users',
            'type' => 'checkbox-select',
            'label' => "Users Assigned",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['users']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => !is_null($menu->users()->where('user_form.user_id', $perm->id)->where('user_form.action', 'assign')->first()) ? true:false
            ];
        }

        $page['fields']['notify'] = [
            'name' => 'notify',
            'type' => 'checkbox-select',
            'label' => "Notify Users On Completed",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['notify']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => !is_null($menu->users()->where('user_form.user_id', $perm->id)->where('user_form.action', 'notify')->first()) ? true:false
            ];
        }

        $page['fields'][] = [
            'name' => 'approval',
            'type' => 'checkbox',
            'label' => "Requires Approval",
            'checked' => $menu->requires_approval == 1 ? true:false,
        ];

        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
             'checked' => $menu->active == 'Active' ? true:false
        ];

        return view($page['template'], $page);
    }

    public function delete(Request $request){
       $form = Form::where('id', $request->query('id'))->firstOrFail();
       $form->delete();
       return redirect()->route('admin.form', ['id' => $form->id])->with('success', 'Successfully deleted form', $form->name);
    }
}
