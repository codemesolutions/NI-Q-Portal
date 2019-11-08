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
use App\Menu;
use App\Permission;

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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Permission();
            $user->name = $request->input('name');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->save();

            if(!is_null($request->input('users'))){
                foreach($request->input('users') as $key => $value){
                    $user->users()->attach(\App\User::where('id', $key)->first());
                }
            }
           
            
            return redirect()->route('admin.permission', ['id' => $user->id])->with('success','Permission created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'   => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        else{
            $user = Permission::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->update();

            $users = [];

         

            if(!is_null($request->input('user'))){
                foreach($request->input('user') as $key => $value){
                    $users[] = $key;
                }
            }
           

            $user->users()->sync($users);
            
            return redirect()->route('admin.permission', ['id' => $user->id])->with('success','Permission updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = Permission::where('id', $request->query('id'))->firstOrFail();
        $form->delete();
        return redirect()->route('admin.permissions')->with('success', 'Successfully deleted Permission');
     }


  
}
