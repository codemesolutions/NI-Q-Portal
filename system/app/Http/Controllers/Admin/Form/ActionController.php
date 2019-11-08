<?php

namespace App\Http\Controllers\Admin\Form;

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
use App\NotificationTypes;
use App\Donor;
use App\User;

class ActionController extends Controller
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


    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required']
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $tableName = uniqid();

           // Form::createTable($tableName);

            $user = new \App\Form();
            $user->name = $request->input('name');
            
           
            $user->form_type_id = $request->input('type');
        
            $user->active = !is_null($request->input('status')) && $request->input('status') == 'on' ? true:false; 
            $user->save();

            if(!is_null($request->input('users'))){
                foreach($request->input('users') as $key => $value){
                    $user->users()->attach(User::where('id', $key)->first(), ['action' =>'assign']);
                }
            }


            if(!is_null($request->input('notify'))){
                foreach($request->input('notify') as $key => $value){
                    $user->users()->attach(User::where('id', $key)->first(), ['action' => 'notify']);
                }
            }
            
            
           

            return redirect()->route('admin.form', ['id' => $user->id]);
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\Form::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->form_type_id = $request->input('type');
            $user->active = !is_null($request->input('status')) && $request->input('status') == 'on' ? true:false; 
            $user->update();

            $users = [];

            
            if(!is_null($request->input('donors'))){
                foreach($request->input('donors') as $key => $value){
                    $users[] = ['user_id' => $key, 'action' => 'assign'];

                    $notify = new Notifications();
                    $notify->notification_type_id = NotificationTypes::where('name', 'Form Assigned')->first()->id;
                    $notify->message = 'You where just assigned the ' . $user->name . ' form';
                    $notify->resource = '/donor/form?name=' . $user->name;
                    $notify->save();
                    $notify->users()->attach($key);
                }

                
               
            }
           
            $users = [];
            if(!is_null($request->input('notify'))){
                foreach($request->input('notify') as $key => $value){
                    
                    $users[] = ['user_id' => $key, 'action' => 'notify'];
                }
            }
            

            if(!is_null($request->input('users'))){
                foreach($request->input('users') as $key => $value){
                    
                    $users[] = ['user_id' => $key, 'action' => 'assign'];
                }
            }

           
            $user->users()->sync($users);

           

           
            return redirect()->route('admin.form', ['id' => $user->id])->with('success', "Form $user->name successfully updated");
        }

    }


  
}
