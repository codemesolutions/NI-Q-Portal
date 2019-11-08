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

class DonorController extends Controller
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:2'],
            'zip' => ['required', 'integer'],
            'user' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/donors')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Donor();
            $user->user_id = $request->input('user');
            $user->donor_id = $request->input('donor_id');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->address= $request->input('address');
            $user->address2= $request->input('address2');
            $user->city= $request->input('city');
            $user->state= $request->input('state');
            $user->zipcode= $request->input('zip');
            $user->phone_home= $request->input('home_phone');
            $user->phone_cell= $request->input('cell_phone');
            $user->save();

         
            
            return redirect('admin/donors')->with('success','Donor created successfully!');
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
