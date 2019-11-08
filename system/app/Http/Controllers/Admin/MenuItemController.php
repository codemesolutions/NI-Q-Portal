<?php

namespace App\Http\Controllers\Admin;

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
use App\MenuItem;

class MenuItemController extends Controller
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
            $page = $this->getPage($request);
           
            $page['menu'] = Menu::where('id', $request->query('id'))->first();
            $page['title'] = $page['menu']->name ." / ". $page['title'];
            return view($page['template'], $page);
        }

        return redirect()->back()->with("message", "invalid menu id");
       
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
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
            $user = new \App\MenuItem();
            $user->menu_id = $request->input('menu');
            $user->name = $request->input('name');
            $user->path = $request->input('path');
           
            $user->save();
            
            foreach($request->input('role') as $key => $value){
                $user->permissions()->attach(\App\Permission::where('id', $key)->first());
            }
            
            return redirect()->back()->with('success','Menu Item created successfully!');
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
            return redirect()
                        ->back()
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
            foreach($request->input('role') as $key => $value){
                $roles[] = $key;
            }

            $user->permissions()->sync($roles);

            return redirect()->back()->with('success','Menu Item updated successfully!');
        }

    }


  
}
