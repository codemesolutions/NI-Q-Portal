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
use App\NotificationTypes;

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
            'menu' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string'], 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\MenuItem();
            $user->menu_id = $request->input('menu');
            $user->name = $request->input('name');
            $user->path = $request->input('path');
            $user->save();


     
            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $user->permissions()->attach(\App\Permission::where('id', $key)->first());
                }
            }
            
            return redirect()->route('admin.menu', ['id' => $user->menu_id])->with('success','Menu Item created successfully!');
        }

    }


    public function update(Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'menu' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string'], 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\MenuItem::where('id', $request->input('id'))->first();
            $user->menu_id = $request->input('menu');
            $user->name = $request->input('name');
            $user->path = $request->input('path');
            $user->update();

            $roles = [];

            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $roles[] = $key;
                }
            }
           

            $user->permissions()->sync($roles);

            return redirect()->route('admin.menu-item', ['id' => $user->id])->with('success','Menu Item updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = \App\MenuItem::where('id', $request->query('id'))->firstOrFail();
        $menuID = $form->menu_id;
        $form->delete();
        return redirect()->route('admin.menu', ['id' => $menuID])->with('success', 'Successfully deleted Menu Item');
     }
}
