<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\FormType;
use App\User;
use App\Permission;
use App\Notifications;
use App\NotificationTypes;
use App\ValidationRule;
use DB;
use App\Donor;

class FormsController extends Controller
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


    public function view(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
       $form_page = null;
       $form_page_layout = null;

 
        $form_page = \App\FormPage::where('id', $request->query('page'))->first();


        $tables = [];

        $results = DB::select('SHOW TABLES');
        
        foreach($results as $result){
            $tables[] = $result->Tables_in_portal;
        } 

       
        $page = $this->getPage($request);
        $page['footer'] = false;
        $page['form'] = Form::where('id', $request->query('id'))->first();
        $page['form_pages'] = $page['form']->pages()->get();
        $page['form_current_page'] = $form_page;
        $page['validation_rules'] = ValidationRule::all();
        $page['tables'] = $tables;
        $page['sidebarHide'] = true;

        return view($page['template'], $page);

       
    }

    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required']
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/forms')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $tableName = uniqid();

           // Form::createTable($tableName);

            $user = new \App\Form();
            $user->name = $request->input('name');
            $user->table_name = $tableName;
            $user->description = $request->input('description');
            $user->form_type_id = $request->input('type');
            $user->requires_approval = !is_null($request->input('approve')) && $request->input('approve') == 'on' ? true:false; 
            $user->active = !is_null($request->input('active')) && $request->input('active') == 'on' ? true:false; 
            $user->save();

            if(!is_null($request->input('donor'))){
                foreach($request->input('donor') as $key => $value){
                    $user->donors()->attach(Donor::where('id', $key)->first());
                }
            }
            
            
            $notify = new Notifications();
            $notify->notification_type_id = NotificationTypes::where('name', 'form created')->first()->id;
            $notify->message = 'There was a new form "'. $user->title .'" created';
            $notify->resource = Route('admin.forms');
            $notify->save();

            return redirect()->route('admin.forms.create', ['id' => $user->id]);
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/forms')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\Form::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->description = $request->input('description');
            $user->form_type_id = $request->input('type');
            $user->requires_approval = !is_null($request->input('approve')) && $request->input('approve') == 'on' ? true:false; 
            $user->active = !is_null($request->input('active')) && $request->input('active') == 'on' ? true:false; 
            $user->update();

           
            return redirect()->route('admin.forms.create', ['id' => $user->id, 'page' => $user->pages()->first()->id]);
        }

    }

    public function build(Request $request){
        if(!is_null($request->query('id'))){
            $form = \App\Form::where('id', $request->query('id'))->first();

            //dd($perm->table_name);

            $fields = [];

            foreach($form->pages()->get() as $page){
                foreach($page->fields()->get() as $field){
                    if($field->type == 'input.text' || $field->type == 'input.password' || $field->type == 'select' ){
                        $fields[] = strtolower(str_replace(' ' , '_', $field->name));
                    }
                    
                }
            }

          
           
            $table = Form::createTable($form->table_name, $fields);
            $form->table_name = $table;
            $form->update();

          
            return redirect()->route('admin.forms');
            
        }

        else{
            abort(404);
        }
    }

}
