<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;

class PermissionController extends Controller
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

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/permissions')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Permission();
            $user->name = $request->input('name');
            $user->active = !is_null($request->input('active')) && $request->input('active') == 'on' ? true:false; 
            $user->save();

            foreach($request->input('user') as $key => $value){
                $user->users()->attach(\App\User::where('id', $key)->first());
            }

            return redirect('admin/permissions')->with('success','Permission created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/permissions')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $perm = \App\Permission::where('id', $request->input('id'))->first();
            $perm->name = $request->input('name');
            $perm->active = $request->input('status') == "on" ? 1:0;
            $perm->update();

            $users = [];
            foreach($request->input('user') as $key => $value){
                $users[] = $key;
            }

            $perm->users()->sync($users);

            return redirect('admin/permissions')->with('success','Permission updated successfully!');
        }

    }


  
}
