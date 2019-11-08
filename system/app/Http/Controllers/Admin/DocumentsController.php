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

class DocumentsController extends Controller
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/users')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            foreach($request->input('role') as $key => $value){
                $user->permissions()->attach(\App\Permission::where('id', $key)->first());
            }
            
            return redirect('admin/users')->with('success','User created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/users')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\User::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->active = $request->input('status') == "on" ? 1:0;
            $user->update();

            $roles = [];
            foreach($request->input('role') as $key => $value){
                $roles[] = $key;
            }

            $user->permissions()->sync($roles);

            return redirect('admin/users')->with('success','User updated successfully!');
        }

    }


  
}
