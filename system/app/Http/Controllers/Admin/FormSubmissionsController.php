<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\FormType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB;
use Carbon\Carbon;
use App\Permission;

class FormsSubmissionsController extends Controller
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
        if(!is_null($request->query('id'))){
            $form = Form::where('id', $request->query('id'))->first();

            $page = $this->getPage($request);
            $page['form'] = $form;
            $page['columns'] = Schema::getColumnListing($form->table_name);
            $page['submissions'] =  DB::table($form->table_name)->get();

            return view($page['template'], $page);
        }

        else{
            return \redirect()->back()->with('message', 'No form found with that id');
        }
       
    }

    public function approve(Request $request){
        $submission = $request->query('submission');
        $form = Form::where('id', $request->query('form'))->first();

        $submitted = (array)DB::table($form->table_name)->where('id', $submission)->first();

        $mapped = [];
        //dd($submitted);
        foreach($form->pages()->get() as $page){
            foreach($page->fields()->get() as $field){ 
               
                if(!is_null($field->mapped_table) && !empty($field->mapped_table)){
                    if(!isset($mapped[$field->mapped_table])){
                        $mapped[$field->mapped_table] = [
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    
                    
                    $submit = $submitted[strtolower(str_replace(' ', '_', $field->name))];

                    if($field->name == 'password'){
                        $submit = \bcrypt($submitted[$field->name]);
                    }

                    $mapped[$field->mapped_table][$field->mapped_column] = $submit;
                }
            }
        }

        

        if(isset($mapped['donors']) && isset($mapped['users'])){
            DB::table('users')->insert($mapped['users']);
            $user_id = DB::getPdo()->lastInsertId();
            DB::table('user_permission')->insert(['user_id' => $user_id, 'permission_id' => Permission::where('name', 'donor')->first()->id]);
            $mapped['donors']['user_id'] = $user_id;
            $mapped['donors']['donor_id'] = \uniqid();
            unset($mapped['users']);
        }

       
        foreach($mapped as $table => $columns){
            DB::table($table)->insert($columns);
        }

        return \redirect()->back()->with('message', "Successfully approved and mapped");

    }
}
