<?php

namespace App\Http\Controllers\Admin\User;

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
use App\User;
use Illuminate\Support\Facades\Auth;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        else{
            $user = new \App\User();

            $user->name = $request->input('name');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $user->permissions()->attach(\App\Permission::where('id', $key)->first());
                }
            }


            return redirect('admin/users/user?id='.$user->id)->with('success','User created successfully!');
        }

    }


    public function update(Request $request){


        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'confirmed'],
        ]);



        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }



        else{
            $user = \App\User::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->active = $request->input('status') == "on" ? 1:0;
            $user->update();

            $roles = [];

            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $roles[] = $key;
                }
            }


            $user->permissions()->sync($roles);

            return redirect('admin/users/user?id='.$user->id)->with('success','User created successfully!');
        }

    }

    public function updateUserAccount(Request $request){

        $validator = Validator::make($request->all(), [

            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],

        ]);



        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }



        else{
            $user = \App\User::where('id', $request->input('id'))->first();
            $user->name = $request->input('first_name')[0] . "." . $request->input('last_name');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->home_phone = $request->input('home_phone');
            $user->cell_phone = $request->input('cell_phone');

            if(!is_null($request->input('password'))){
                $user->password = bcrypt($request->input('password'));
            }


            $user->update();

            $donor = \App\Donor::where('user_id', $user->id)->first();
            $donor->mailing_address= $request->input('mailing_address');
            $donor->mailing_address2= $request->input('mailing_address2');
            $donor->mailing_city= $request->input('mailing_city');
            $donor->mailing_state= $request->input('mailing_state');
            $donor->mailing_zipcode= $request->input('mailing_zipcode');
            $donor->shipping_address= $request->input('shipping_address');
            $donor->shipping_address2= $request->input('shipping_address2');
            $donor->shipping_city= $request->input('shipping_city');
            $donor->shipping_state= $request->input('shipping_state');
            $donor->shipping_zipcode= $request->input('shipping_zipcode');
            $donor->update();

            return redirect('/account')->with('success','User updated successfully!');
        }

    }

    public function updateUserAccountShipping(Request $request){

        $validator = Validator::make($request->all(), [


            'shipping_address' => ['sometimes', 'string'],
            'shipping_city' => ['sometimes',  'string'],
            'shipping_state' => ['sometimes',  'string'],
            'shipping_zipcode' => [ 'sometimes', 'numeric'],
        ]);



        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }



        else{


            $donor = \App\Donor::where('user_id', $request->user()->id)->first();

            $donor->shipping_address= $request->input('shipping_address');
            $donor->shipping_address2= $request->input('shipping_address2');
            $donor->shipping_city= $request->input('shipping_city');
            $donor->shipping_state= $request->input('shipping_state');
            $donor->shipping_zipcode= $request->input('shipping_zipcode');
            $donor->update();

            return redirect('/account')->with('success','User updated successfully!');
        }

    }

    public function updateUserAccountMailing(Request $request){

        $validator = Validator::make($request->all(), [


            'mailing_address' => ['required', 'string'],
            'mailing_city' => ['required', 'string'],
            'mailing_state' => ['required', 'string'],
            'mailing_zipcode' => ['required', 'numeric'],
        ]);



        if ($validator->fails()) {

            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }



        else{


            $donor = \App\Donor::where('user_id', $request->user()->id)->first();

            $donor->mailing_address= $request->input('mailing_address');
            $donor->mailing_address2= $request->input('mailing_address2');
            $donor->mailing_city= $request->input('mailing_city');
            $donor->mailing_state= $request->input('mailing_state');
            $donor->mailing_zipcode= $request->input('mailing_zipcode');
            $donor->update();

            return redirect('/account')->with('success','User updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = \App\User::where('id', $request->query('id'))->firstOrFail();
        $form->delete();
        return redirect()->route('admin.users')->with('success', 'Successfully deleted user');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric', 'exists:users'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::where('id', $request->query('id'))->first();

        if(is_null($user)){
            return redirect()->back()->with('error', "Invalid User ID");
        }

        Auth::login($user);

        return redirect('/');
    }

}
